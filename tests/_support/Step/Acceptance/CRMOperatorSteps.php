<?php
namespace Step\Acceptance;

class CRMOperatorSteps extends \AcceptanceTester
{
    public $faker;

    public function amInAddCustomerUi()
    {
        $I = $this;
        $I->amOnPage('/customers/add');
    }

    public function imagineCustomer()
    {
        $faker = \Faker\Factory::create();
        return [
            'CustomerRecord[name]' => $faker->name,
            'CustomerRecord[birth_date]' => $faker->date('Y-m-d'),
            'CustomerRecord[notes]' => $faker->sentence(8),
            'PhoneRecord[number]' => $faker->phoneNumber
        ];
    }

    public function fillDataForm($fieldsData)
    {
        $I = $this;

        foreach ($fieldsData as $key => $value)
        {
            $I->fillField($key, $value);
        }
    }

    public function submitDataForm()
    {
        $I = $this;
        $I->click('button[type=submit]');
    }

    public function seeIAmInListCustomersUi()
    {
        $I = $this;
        $I->seeCurrentUrlMatches('/customers/');
    }

    public function amInListCustomersUi()
    {
        $I = $this;
        $I->amOnPage('/customers');
    }

    public function imagineService() {
        $faker = \Faker\Factory::create();
        return [
            'ServiceRecord[name]' => $faker->sentence(),
            'ServiceRecord[hourly_rate]' => $faker->numberBetween(5, 40),
        ];
    }

    public function addService() {
        $I = $this;
        $I->amOnpage('/services/create');

        $service = $I->imagineService();

        $I->fillDataForm($service);
        $I->submitDataForm();

        return $service;
    }
}