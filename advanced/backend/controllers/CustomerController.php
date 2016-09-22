<?php

namespace backend\controllers;

use backend\models\customer\Phone;
use backend\models\customer\Customer;
use backend\models\customer\CustomerRecord;
use backend\models\customer\PhoneRecord;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class CustomerController extends Controller
{
    public function actionIndex()
    {
        $number = \Yii::$app->request->get('phone_number');
        if ($number) {
            $records = $this->findRecordsByQuery($number);
        } else {
            $records = $this->findAllRecords();
        }

        return $this->render('index', compact('records'));
    }

    public function actionAdd()
    {
        $customer = new CustomerRecord;
        $phone = new PhoneRecord();

        if($this->load($customer, $phone, $_POST))
        {
            $this->store($this->makeCustomer($customer, $phone));
            return $this->redirect('/customer');
        }

        return $this->render('add', compact('customer', 'phone'));
    }

    public function actionQuery()
    {
        return $this->render('query');
    }

    private function findAllRecords()
    {
        $records = [];
        $customerRecords = CustomerRecord::find()->all();
        foreach($customerRecords as $record) {
            $phoneRecord = PhoneRecord::findOne(['customer_id' => $record->id]);
            $records[] = $this->makeCustomer($record, $phoneRecord);
        }

        $dataProvider = $this->wrapIntoDataProvider($records);
        return $dataProvider;
    }

    private function findRecordsByQuery($number)
    {
        $records = $this->getRecordsByPhoneNumber($number);
        $dataProvider = $this->wrapIntoDataProvider($records);
        return $dataProvider;
    }

    private function wrapIntoDataProvider($data)
    {
        return new ArrayDataProvider(
            [
                'allModels' => $data,
                'pagination' => false
            ]
        );
    }

    private function getRecordsByPhoneNumber($number)
    {
        $phoneRecord = PhoneRecord::findOne(['number' => $number]);
        if (!$phoneRecord)
            return [];

        $customerRecord = CustomerRecord::findOne($phoneRecord->customer_id);
        if (!$customerRecord)
            return [];

        return [$this->makeCustomer($customerRecord, $phoneRecord)];
    }

    private function load(CustomerRecord $customer, PhoneRecord $phone, array $post)
    {
        return $customer->load($post)
            and $phone->load($post)
            and $customer->validate()
            and $phone->validate(['number']);
    }

    private function store(Customer $customer)
    {
        $customerRecord = new CustomerRecord();
        $customerRecord->name = $customer->name;
        $customerRecord->birth_date = $customer->birthDate->format('Y-m-d');
        $customerRecord->notes = $customer->notes;
        $result = $customerRecord->save();

        foreach ($customer->phones as $phone)
        {
            $phoneRecord = new PhoneRecord();
            $phoneRecord->number = $phone->number;
            $phoneRecord->customer_id = $customerRecord->id;
            $result = $phoneRecord->save();
        }
    }

    private function makeCustomer(CustomerRecord $customerRecord, PhoneRecord $phoneRecord = null)
    {
        $name = $customerRecord->name;
        $birthDate = new \DateTime($customerRecord->birth_date);

        $customer = new Customer($name, $birthDate);
        $customer->notes = $customerRecord->notes;
        if ($phoneRecord)
            $customer->phones[] = new Phone($phoneRecord->number);

        return $customer;
    }

}