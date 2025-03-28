<?php

namespace app\controllers;

use app\models\Event;
use app\models\EventRegistrations;
use Yii;

class EventRegistrationsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionApply($id)
    {
        $event = Event::findOne($id);

        $existingRegistration = EventRegistrations::find()
            ->where(['event_id' => $id, 'user_id' => Yii::$app->user->id])
            ->one();

        if ($existingRegistration) {
            Yii::$app->session->setFlash('error', 'Вы уже зарегистрированы на это мероприятие.');
            return $this->redirect(['event/index']);
        }

        $model = new EventRegistrations();
        $model->event_id = $id;
        $model->user_id = Yii::$app->user->id;
        $model->registration_date = new \yii\db\Expression('NOW()');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $user = Yii::$app->user->identity;
                Yii::$app->mailer->compose()
                    ->setFrom(['inga.komogorova.6_9@mail.ru' => 'Организаторы мероприятия'])
                    ->setTo($user->email)
                    ->setSubject('Успешная регистрация на мероприятие')
                    ->setHtmlBody("
                <h3>Здравствуйте, {$user->username}!</h3>
                <p>Мы рады сообщить вам, что вы успешно зарегистрированы на мероприятие <strong>{$event->title}</strong>! 🎉</p>
                <p>Спасибо, что выбрали VolunteerHub — платформу, которая связывает волонтеров и организации для совместной работы над важными проектами.</p>
                <p>Скоро мы свяжемся с вами, чтобы уточнить все детали и ответить на ваши вопросы.</p>
                <p>Если у вас возникнут какие-либо вопросы, не стесняйтесь обращаться к нам!</p>
                <p>С наилучшими пожеланиями,<br>Команда VolunteerHub</p>
            ")
                    ->send();

                Yii::$app->session->setFlash('success', 'Вы успешно зарегистрированы на мероприятие! Письмо с подтверждением отправлено на ваш email.');
                return $this->redirect(['event/index']);
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при регистрации: ' . implode(', ', $model->getFirstErrors()));
            }
        }

        return $this->render('apply', [
            'model' => $model,
            'event' => $event,
        ]);
    }


    public function actionDelete($id)
    {
        $registration = EventRegistrations::findOne($id);

        if ($registration && $registration->user_id === Yii::$app->user->id) {
            $registration->delete();
            Yii::$app->session->setFlash('success', 'Регистрация на мероприятие успешно отменена.');
        } else {
            Yii::$app->session->setFlash('error', 'У вас нет прав на отмену этой регистрации.');
        }

        return $this->redirect(['event/your-events']);
    }

}