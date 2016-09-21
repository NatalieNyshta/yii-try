<?php

namespace backend\controllers;

use backend\models\customer\Phone;
use backend\models\customer\Customer;
use backend\models\customer\CustomerRecord;
use backend\models\customer\PhoneRecord;
use yii\web\Controller;

class CustomerController extends Controller
{
    public function actionIndex()
    {
        $records = $this->findRecordsByQuery();
        return $this->render('index', compact('records'));
    }

    public function actionAdd()
    {
        $customer = new CustomerRecord;
        $phone = new PhoneRecord();
        return $this->render('add', compact('customer', 'phone'));
    }

    private function store(Customer $customer)
    {
        $customerRecord = new CustomerRecord();
        $customerRecord->name = $customer->name;
        $customerRecord->birth_date = $customer->birthDate;
        $customerRecord->notes = $customer->notes;

        $customerRecord->save();

        foreach ($customer->phones as $phone)
        {
            $phoneRecord = new PhoneRecord();
            $phoneRecord->number = $phone->number;
            $phoneRecord->customer_id = $customerRecord->id;
            $phoneRecord->save();
        }
    }

    private function makeCustomer(CustomerRecord $customerRecord, PhoneRecord $phoneRecord)
    {
        $name = $customerRecord->name;
        $birthDate = new \DateTime($customerRecord->birth_date);

        $customer = new Customer($name, $birthDate);
        $customer->notes = $customerRecord->notes;
        $customer->phones[] = new Phone($phoneRecord->number);
    }

}