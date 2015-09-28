<?php

namespace Step\Acceptance;
use Step\Acceptance\CRMOperatorSteps;


class CRMServiceManagerSteps extends CRMOperatorSteps
{
    public function imagineService()
    {
        $faker = \Faker\Factory::create();
        return [
            'ServiceRecord[name]' => $faker->sentence(),
            'ServiceRecord[hourly_rate]' => $faker->numberBetween(5, 40),
        ];
    }

    public function addService()
    {
        $I = $this;
        $I->amOnpage('/services/create');

        $service = $I->imagineService();

        $I->fillDataForm($service);
        $I->submitDataForm();

        return $service;
    }
}