<?php
namespace Step\Acceptance;

class CRMUserSteps extends \AcceptanceTester
{
    public function amInQueryCustomerUi()
    {
        $I = $this;
        $I->amOnPage('/customer/query');
    }

    public function fillInPhoneFieldWithDataFrom($customerData)
    {
        $I = $this;
        $I->fillField(
            'phone_number',
            $customerData['PhoneRecord[number]']
        );
    }

    public function clickSearchButton()
    {
        $I = $this;
        $I->click('Search');
    }

    public function seeIAmInListCustomersUi()
    {
        $I = $this;
        $I->seeCurrentUrlMatches('/customer/');
    }

    public function seeCustomerInList($customerData)
    {
        $I = $this;
        $I->see($customerData['CustomerRecord[name]'], '#search_results');
    }

    public function dontSeeCustomerInList($customerData)
    {
        $I = $this;
        $I->dontSee($customerData['CustomerRecord[name]'], '#search_results');
    }
}