<?php

namespace app\controllers;

use app\models\SendForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $users = User::find()->orderBy('id')->all();
        return $this->render('index', compact("users"));
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model= new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', compact("model"));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSend()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model= new SendForm();
        if ($model->load(Yii::$app->request->post()) && $model->send()) {
            Yii::$app->session->setFlash('success','Money successfully sent');
            return $this->redirect(['site/send']);
        }
        return $this->render('send', compact("model"));
    }

    public function actionHistory()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $income = Yii::$app->user->identity->income;
        $expenses = Yii::$app->user->identity->expenses;
		$history = array_merge($income, $expenses);
		usort($history, [$this, "cmp"]);
        return $this->render('history', compact("history"));
    }
	
	private function cmp($a, $b){
		return strcmp($b->id, $a->id);
	}
}
