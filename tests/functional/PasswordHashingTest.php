<?php


class PasswordHashingTest extends \Codeception\TestCase\Test
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    // public function testMe()
    // {

    // }

    public function PasswordIsHashedWhenSavingUser()
    {
        $user = $this->imagineUserRecord();
        $plaintext_password = $user->password; //1
        $user->save();
        // Don't care about mutated model now, just fetch new one.

        $saved_user = UserRecord::findOne($user->id); //2

        $security = new \yii\base\Security();

        $this->assertInstanceOf(get_class($user), $saved_user);
        $this->assertTrue(
            $security->validatePassword( // 3
                $plaintext_password,
                $saved_user->password
            )
        );
    }

    private function imagineUserRecord()
    {
        $faker = Faker\Factory::create();
        $user = new UserRecord();
        $user->username = $faker->word;
        $user->password = md5(time());

        return $user;
    }
}