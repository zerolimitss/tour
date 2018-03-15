<?php


class LogoutCest
{
    public function logoutClick(FunctionalTester $I)
    {
        $I->amOnPage(['site/login']);
        $I->fillField('input[name="LoginForm[username]"]', 'admin');
        $I->click('login-button');
        $I->click('.logout');
        $I->dontSee('Logout');
    }
}
