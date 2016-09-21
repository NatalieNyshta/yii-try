<?php

namespace backend\models\customer;

class Customer
{
    /** @var string */
    public $name;

    /** @var \DateTime */
    public $birthDate;

    /** @var string */
    public $notes = '';

    /** @var PhoneRecord[] */
    public $phones = [];

    public function __construct($name, $birthDate)
    {
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

}