<?php 
$I = new Step\Acceptance\CRMOperatorSteps($scenario);
$I->wantTo('add two different customers to database');

$I->amInAddCustomerUi();
$firstCustomer = $I->imagineCustomer();
$I->fillCustomerDataFrom($firstCustomer);
$I->submitCustomerDataForm();

$I->seeIAmInListCustomersUi();

$I->amInAddCustomerUi();
$secondCustomer = $I->imagineCustomer();
$I->fillCustomerDataFrom($secondCustomer);
$I->submitCustomerDataForm();

$I->seeIAmInListCustomersUi();

$I = new Step\Acceptance\CRMUserSteps($scenario);
$I->wantTo('query the customer info using his phone number');

$I->amInQueryCustomerUi();
$I->fillInPhoneFieldWithDataFrom($firstCustomer);
$I->clickSearchButton();

$I->seeIAmInListCustomersUi();
$I->seeCustomerInList($firstCustomer);
$I->dontSeeCustomerInList($secondCustomer);


