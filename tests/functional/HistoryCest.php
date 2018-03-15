<?php


class HistoryCest
{

    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site/login']);
        $I->fillField('input[name="LoginForm[username]"]', 'fff');
        $I->click('login-button');
    }

    public function testAccess(FunctionalTester $I)
    {
        $I->amOnPage(['site/history']);
        $I->seeInTitle('History');
        $I->see('Amount');
    }

    public function testExpenses(FunctionalTester $I)
    {
        $faker = Faker\Factory::create();
        $amount = $faker->randomFloat(2,0,100);
        $I->amOnPage(['site/send']);
        $I->seeInTitle('Send money');
        $I->fillField('input[name="SendForm[login]"]', 'fff1');
        $I->fillField('input[name="SendForm[amount]"]', $amount);
        $I->click('send-button');
        $I->see('Money successfully sent');
        $I->amOnPage(['site/history']);
        $I->see($amount);
    }

    public function testIncome(FunctionalTester $I)
    {
        $faker = Faker\Factory::create();
        $amount = $faker->randomFloat(2,0,100);
        $I->amOnPage(['site/send']);
        $I->seeInTitle('Send money');
        $I->fillField('input[name="SendForm[login]"]', 'fff1');
        $I->fillField('input[name="SendForm[amount]"]', $amount);
        $I->click('send-button');
        $I->see('Money successfully sent');
        $I->click('.logout');
        $I->amOnPage(['site/login']);
        $I->fillField('input[name="LoginForm[username]"]', 'fff1');
        $I->click('login-button');
        $I->amOnPage(['site/history']);
        $I->see($amount);
    }

    public function testSendToMyself(FunctionalTester $I)
    {
        $I->amOnPage(['site/send']);
        $I->seeInTitle('Send money');
        $I->fillField('input[name="SendForm[login]"]', 'fff');
        $I->fillField('input[name="SendForm[amount]"]', 1);
        $I->click('send-button');
        $I->see('Wrong login');
    }

}
