<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SendForm extends Model
{
    public $amount;
    public $login;

    public function rules()
    {
        return [
            [['amount','login'], 'required'],
            [['amount'], 'double', 'min'=>0],
        ];
    }

    public function send()
    {
        if ($this->validate()) {
            $currentUser = Yii::$app->user->identity;
            $errors = false;
            if($this->login == $currentUser->username){
                Yii::$app->session->addFlash('error','Wrong login');
                $errors = true;
            }
            if($currentUser->balance - $this->amount<-1000){
                Yii::$app->session->addFlash('error','Not enough money');
                $errors = true;
            }
            if($errors) return false;

            $user = User::findByUsername($this->login);
            $user->balance = $user->balance + $this->amount;
            $currentUser->balance = $currentUser->balance - $this->amount;
            $user->save();
            $currentUser->save();

            $history = new History();
            $history->user_id = $currentUser->id;
            $history->receiver_id = $user->id;
            $history->date = date("Y-m-d H:i:s");;
            $history->amount = $this->amount;
            $history->save();
            return true;
        }
        return false;
    }
}
