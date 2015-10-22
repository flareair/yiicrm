<?php

use yii\db\Schema;
use yii\db\Migration;
use app\models\user\UserRecord;

class m151021_132830_init_rbac extends Migration
{
    private $usersArray = [
        [
            'username' => 'JoeUser',
            'password' => '1234'
        ],
        [
            'username' => 'AnnieManager',
            'password' => '1234'
        ],
        [
            'username' => 'RobAdmin',
            'password' => '1234'
        ],

    ];
    private function createStandartUsers() {
        foreach ($this->usersArray as $user) {
            $model = new UserRecord();
            var_dump($model->load($user));
            if ($model->load($user) && $model->save()) {
                echo 'User ' . $user['username'] . ' created';
            } else {
                echo 'Error creating ' . $user['username'];
            }
        }
    }
    public function up()
    {
        // $this->createStandartUsers();

        $rbac = \Yii::$app->authManager;
        $guest = $rbac->createRole('guest');
        $guest->description = 'Nobody';
        $rbac->add($guest);

        $user = $rbac->createRole('user');
        $user->description = 'Can use the query UI and nothing else';
        $rbac->add($user);

        $manager = $rbac->createRole('manager');
        $manager->description = 'Can manage entities in database, but
        not users';
        $rbac->add($manager);

        $admin = $rbac->createRole('admin');
        $admin->description = 'Can do anything including managing
        users';
        $rbac->add($admin);

        $rbac->addChild($admin, $manager);
        $rbac->addChild($manager, $user);
        $rbac->addChild($user, $guest);

        $rbac->assign(
            $user,
            UserRecord::findOne(['username' => 'JoeUser'])->id
        );
        $rbac->assign(
            $manager,
            UserRecord::findOne(['username' => 'AnnieManager'])->id
        );

        $rbac->assign(
            $admin,
            UserRecord::findOne(['username' => 'RobAdmin'])->id
        );
    }

    public function down()
    {
        $manager = \Yii::$app->authManager;
        $manager->removeAll();
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
