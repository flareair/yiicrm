<?php
$I = new \Step\Acceptance\CRMUserManagerSteps($scenario);
$I->wantTo('Edit user');

$user = $I->addUser();

$I->amOnpage('/users');

$userId = $I->grabTextFrom('//table//tbody//tr[last()]//td[2]');
var_dump($userId);
\Codeception\Util\Debug::debug($userId);
$updateUrl = "/users/update?id=$userId";

$I->click('a[href="' . $updateUrl . '"]');

$I->amOnpage($updateUrl);

$newName = 'Mongo';

$user['UserRecord[username]'] = $newName;

$I->fillDataForm($user);
$I->submitDataForm();

$I->amOnpage('/users');

$I->see($user['UserRecord[username]']);



