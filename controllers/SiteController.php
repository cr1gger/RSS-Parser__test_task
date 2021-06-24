<?php

namespace app\controllers;

use app\models\Feed;
use app\models\ParserLogs;
use app\models\ParserSettings;
use Yii;
use yii\data\ActiveDataProvider;
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
                        'actions' => ['logout', 'parser-setting', 'parser-view', 'request-logs'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],

            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionParserSetting()
    {
        $alert = '';
        $model = ParserSettings::find()->one();
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()))
        {
            try {
                if($model->save()) $alert = 'Сохранено!';
                else {
                    $alert = 'При сохранении возникли ошибки';
                }
            } catch (\Throwable $e) {
                $alert = 'При сохранении возникли ошибки';
            }
        }

        return $this->render('parser-setting', compact('model', 'alert'));
    }
    public function actionParserView()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Feed::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('parser-view', compact('dataProvider'));
    }
    public function actionRequestLogs()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ParserLogs::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('request-logs', compact('dataProvider'));
    }

}
