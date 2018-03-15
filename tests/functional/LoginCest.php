<?php


class LoginCest
{
    public function checkLogin(FunctionalTester $I)
    {
        $I->amOnPage(['site/login']);
        $I->see('Please fill out the following fields to login');
        $I->fillField('input[name="LoginForm[username]"]', 'admin');
        $I->click('login-button');
        $I->see('Logout');
    }
}
