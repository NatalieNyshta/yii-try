<?php
namespace Step\Acceptance;

class CRMOperatorSteps extends \AcceptanceTester
{
    public function amInAddCustomerUi()
    {
        $I = $this;
        $I->amOnPage('/customer/add');
    }

    public function imagineCustomer()
    {
        $faker = \Faker\Factory::create();
        return [
            'CustomerRecord[name]' => $faker->name,
            'CustomerRecord[birth_date]' => $faker->date('Y-m-d'),
            'CustomerRecord[notes]' => $faker->sentences(8, true),
            'PhoneRecord[number]' => $faker->phoneNumber
        ];
    }

    public function fillCustomerDataFrom($fieldsData)
    {
        $I = $this;
        foreach ($fieldsData as $key => $value)
        {
            $I->fillField($key, $value);
        }
    }

    public function submitCustomerDataForm()
    {
        $I = $this;
        $I->click('Submit');
    }

    public function seeIAmInListCustomersUi()
    {
        $I = $this;
        $I->seeCurrentUrlMatches('/customer/');
    }

    public function amInListCustomersUi()
    {
        $I = $this;
        $I->amOnPage('/customer');
    }

    public function seeCustomerInList($customerData)
    {
        $I = $this;
        $I->see($customerData['CustomerRecord[name]'], '#search_results');
    }
}