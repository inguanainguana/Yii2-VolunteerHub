<?php

namespace app\controllers;

use app\models\Event;
use app\models\EventForm;
use app\models\EventRegistrations;
use app\models\Reviews;
use app\models\ReviewsForm;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class EventController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $event = Event::find()->all();
        $context = [
            'event' => $event
        ];
        return $this->render('index', $context);
    }

    public function actionYourEvents()
    {
        $user_id = Yii::$app->user->id;

        $createdEvents = Event::find()->where(['user_id' => $user_id])->all();


        $registeredEvents = EventRegistrations::find()
            ->where(['user_id' => $user_id])
            ->with('event')
            ->all();

        $context = [
            'createdEvents' => $createdEvents,
            'registeredEvents' => $registeredEvents,
        ];
        return $this->render('your-events', $context);
    }

    public function actionCreate()
    {
        $model = new EventForm();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->save()) {
                return $this->redirect(['your-events']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $event = Event::findOne($id);

        if ($event->user_id !== Yii::$app->user->id) {
            Yii::$app->session->setFlash('error', 'У вас нет прав на редактирование этого события.');
            return $this->redirect(['your-events']);
        }

        $model = new EventForm();

        $model->title = $event->title;
        $model->description = $event->description;
        $model->location = $event->location;
        $model->start_date = Yii::$app->formatter->asDatetime($event->start_date, 'dd.MM.yyyy HH:mm');
        $model->end_date = Yii::$app->formatter->asDatetime($event->end_date, 'dd.MM.yyyy HH:mm');

        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->save($event)) {
                return $this->redirect(['your-events']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'event' => $event,
        ]);
    }

    public function actionDelete($id)
    {
        $event = Event::findOne($id);
        if ($event && $event->user_id === Yii::$app->user->id) {
            $event->delete();
            Yii::$app->session->setFlash('success', 'Мероприятие успешно удалено.');
        } else {
            Yii::$app->session->setFlash('error', 'У вас нет прав на удаление этого мероприятия.');
        }
        return $this->redirect(['your-events']);
    }


    public function actionView($id)
    {

        $event = Event::findOne($id);
        $model = new ReviewsForm();


        $model->event_id = $event->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();
        }

        $reviews = Reviews::find()
            ->where(['is_active' => 1, 'event_id' => $event->id])
            ->all();


        return $this->render('view', [
            'event' => $event,
            'model' => $model,
            'reviews' => $reviews,
        ]);
    }


}
