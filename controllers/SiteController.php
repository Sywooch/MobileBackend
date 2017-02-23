<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index', 'contact', 'about', 'change_password', 'actions'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'contact', 'about', 'change_password', 'actions'],
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionChange_password()
    {
        $user = Yii::$app->user->identity;
        $loadedPost = $user->load(Yii::$app->request->post());
        if ($loadedPost) {
            if ($user->validate()) {
                $new_no_hash_password = $user->newPassword;
                $user->password_hash = $user->newPassword;
                $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($user->password_hash);
                $user->save(false);
                //Отправка письма с измененным паролем
                $email = \Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom("crm.urich@gmail.com")
                    ->setSubject('Zappa Admin')
                    ->setTextBody("Здравствуйте, " . $user->username . " Вы успешно изменили свой пароль.\n\nВаш новый пароль: ".$new_no_hash_password)
                    ->send();
                if ($email) {
                    Yii::$app->getSession()->setFlash('success', 'Вы успешно поменяли пароль. Вам был отправлен Email с вашим новым паролем!');
                } else {
                    Yii::$app->getSession()->setFlash('warning', 'Ошибка! Не удалось отправить письмо с паролем.');
                }
                return $this->refresh();
            }
        }
        return $this->render("change_password", [
            'user' => $user,
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
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
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
