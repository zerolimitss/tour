<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class History extends ActiveRecord
{

    public static function tableName()
    {
        return "history";
    }

    public function rules()
    {
        return [
            [['user_id', 'receiver_id', 'amount', 'date'], 'required'],
        ];
    }

    public function getSender(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getReceiver(){
        return $this->hasOne(User::className(), ['id' => 'receiver_id']);
    }
}
