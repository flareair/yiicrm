<?php
$I = new \Step\Acceptance\CRMUserManagerSteps($scenario);
$I->wantTo('Register users');

$users = [];

for ($i=0; $i < 2; $i++) {

    $users[] = $I->addUser();
}

$I->amOnpage('/users');

foreach ($users as $user) {
    $I->see($user['UserRecord[username]']);
}