<?php
$I = new \Step\Acceptance\CRMServiceManagerSteps($scenario);
$I->wantTo('Edit service');

$services = [];

for ($i=0; $i < 2; $i++) {

    $services[] = $I->addService();
}

$I->amOnpage('/services');

foreach ($services as $service) {
    $I->see($service['ServiceRecord[name]']);
    $I->see($service['ServiceRecord[hourly_rate]']);
}