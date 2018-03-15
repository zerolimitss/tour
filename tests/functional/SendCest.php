<?php


class SendCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site/login']);
        $I->fillField('input[name="LoginForm[username]"]', 'admin');
        $I->click('login-button');
    }

    public function submitFormSuccessfully(FunctionalTester $I)
    {
        $I->amOnPage(['site/send']);
        $I->seeInTitle('Send money');
        $I->fillField('input[name="SendForm[login]"]', 'login2');
        $I->fillField('input[name="SendForm[amount]"]', '1.11');
        $I->click('send-button');
        $I->see('Money successfully sent');
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->amOnPage(['site/send']);
        $I->seeInTitle('Send money');
        $I->click('send-button');
        $I->see('Login cannot be blank.');
        $I->see('Amount cannot be blank.');
    }

    public function submitMuchAmount(\FunctionalTester $I)
    {
        $I->amOnPage(['site/send']);
        $I->seeInTitle('Send money');
        $I->fillField('input[name="SendForm[login]"]', 'login2');
        $I->fillField('input[name="SendForm[amount]"]', '10000');
        $I->click('send-button');
        $I->see('Not enough money');
    }
}
