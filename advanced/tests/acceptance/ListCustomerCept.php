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

$I->wantTo('check both new customers in list');
$I->seeCustomerInList($firstCustomer);
$I->seeCustomerInList($secondCustomer);

