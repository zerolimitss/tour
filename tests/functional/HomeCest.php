<?php


class HomeCest
{
    public function testAccess(FunctionalTester $I)
    {
        $I->amOnPage(['site/index']);
        $I->seeInTitle('My Yii Application');
    }

    public function testUser(FunctionalTester $I){
        $faker = Faker\Factory::create();
        $name = $faker->userName;
        $I->amOnPage(['site/login']);
        $I->fillField('input[name="LoginForm[username]"]', $name);
        $I->click('login-button');
        $I->see($name);
    }
}
