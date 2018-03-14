<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName()
    {
        return "users";
    }

    public function rules()
    {
        return [
            [['username'], 'required'],
            [['username'], 'unique'],
            [['balance'], 'number']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user =  static::findOne(['username' => $username]);
        if ($user == false) {
            $user = new User();
            $user->username = $username;
            $user->save();
        }
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    public function getIncome(){
        return $this->hasMany(History::className(), ['receiver_id' => 'id']);
    }

    public function getExpenses(){
        return $this->hasMany(History::className(), ['user_id' => 'id']);
    }
}
