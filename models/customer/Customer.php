<?php

namespace app\models\customer;
class Customer {
    public $name;
    public $birthDate;
    public $phones = [];

    public function __construct($name, $birthDate)
    {
        $this->name = $name;
        $this->birthDate = $birthDate;
    }
}