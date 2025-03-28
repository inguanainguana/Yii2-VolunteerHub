<?php

namespace app\controllers;


use app\models\Event;
use app\models\User;
use Yii;
use yii\web\Controller;

class ActivityController extends Controller
{
    public function actionIndex()
    {
        $currentUserId = Yii::$app->user->id;

        if ($currentUserId === null) {
            return $this->redirect(['site/login']);
        }

        $user = User::findOne($currentUserId);
        $friendsEvents = $user->getFriendsEvents();

        $recommendedEvents = Event::find()
            ->orderBy('RAND()')
            ->limit(2)
            ->all();

        $totalEventsCount = Event::find()->count();

        return $this->render('index', [
            'friendsEvents' => $friendsEvents,
            'recommendedEvents' => $recommendedEvents,
            'totalEventsCount' => $totalEventsCount,
        ]);
    }


}
