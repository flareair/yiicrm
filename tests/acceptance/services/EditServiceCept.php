<?php
$I = new \Step\Acceptance\CRMServiceManagerSteps($scenario);
$I->wantTo('Edit service');

$service = $I->addService();

$I->amOnpage('/services');

$serviceId = $I->grabTextFrom('//table//tbody//tr[last()]//td[2]');


$updateUrl = "/services/update?id=$serviceId";

$I->click('a[href="' . $updateUrl . '"]');

$I->amOnpage($updateUrl);

$newName = 'Make my day';

$service['ServiceRecord[name]'] = $newName;

$I->fillDataForm($service);
$I->submitDataForm();

$I->amOnpage('/services');

$I->see($service['ServiceRecord[name]']);
$I->see($service['ServiceRecord[hourly_rate]']);



