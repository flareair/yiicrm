<?php

namespace Step\Acceptance;
use Step\Acceptance\CRMOperatorSteps;


class CRMUserManagerSteps extends CRMOperatorSteps
{
    public function imagineUser()
    {
        $faker = \Faker\Factory::create();
        return [
            'UserRecord[username]' => $faker->userName(),
            'UserRecord[password]' => $faker->password(),
        ];
    }

    public function addUser()
    {
        $I = $this;
        $I->amOnpage('/users/create');

        $user = $I->imagineUser();

        $I->fillDataForm($user);
        $I->submitDataForm();

        return $user;
    }
}