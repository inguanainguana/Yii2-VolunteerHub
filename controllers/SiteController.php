<?php

namespace app\controllers;

use app\models\Event;
use app\models\EventRegistrations;
use app\models\Follows;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
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
        $events = Event::find()->all();
        $event = array_slice($events, 0, 5);

        return $this->render('index', [
            'event' => $event,
        ]);
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
            if (Yii::$app->user->identity->is_admin) {
                return $this->redirect(['admin/default/index']);
            }
            return $this->redirect(['activity/index']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect(['site/login']);
        }

        $model->password = '';
        return $this->render('register', [
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

    /**
     * Displays contact page.
     *
     * @return Response|string
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

    public function actionProfile($id = null)
    {
        $currentUserId = $id ? $id : Yii::$app->user->id;

        if ($currentUserId === null) {
            return $this->redirect(['site/login']);
        }

        $model = User::findOne($currentUserId);

        if ($model === null) {
            throw new NotFoundHttpException('Такого пользователя нет.');
        }

        $isFollowing = Follows::find()->where(['user_id' => Yii::$app->user->id, 'followed_id' => $model->id])->exists();

        $createdEvents = Event::find()->where(['user_id' => $model->id])->all();
        $registeredEvents = EventRegistrations::find()->where(['user_id' => $model->id])->with('event')->all();

        return $this->render('profile', [
            'model' => $model,
            'isFollowing' => $isFollowing,
            'currentUserId' => Yii::$app->user->id,
            'createdEvents' => $createdEvents,
            'registeredEvents' => $registeredEvents,
        ]);
    }


    public function actionActivityFeed()
    {
        $user = User::findOne(Yii::$app->user->id);
        $events = $user->getFriendEvents();

        return $this->render('activity-feed', [
            'events' => $events,
        ]);
    }


}
