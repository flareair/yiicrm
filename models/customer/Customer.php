<?php

namespace app\models\customer;
class Customer {
    public $name;
    private $birthDate;
    public $phones = [];

    public function __construct($name)
    {
        $this->name = $name;
    }
    public function setBirthDate($date, $format = 'Y-m-d') {
        if (isset($date) && !empty($date)) {
            $this->birthDate = \Datetime::createFromFormat($format, $date);
        }
    }

    public function getBirthDate($format = 'Y-m-d') {
        if ($this->birthDate && !empty($this->birthDate)) {
            return $this->birthDate->format($format);
        }
    }
}