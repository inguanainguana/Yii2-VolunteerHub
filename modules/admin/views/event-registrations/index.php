<?php

use app\models\Event;
use app\models\EventRegistrations;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\EventRegistrationsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Регистрация волонтеров';
?>
<div class="event-registrations-index mt-4">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Зарегистрировать волонтера', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
            'attribute' => 'event_id',
            'value' => function ($model) {

                $event = Event::findOne($model->event_id);
                return $event ? $event->title : 'Не найдено';
            },
        ],
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return User::findOne($model->user_id)->getFullName();
                },
            ],
            [
                'attribute' => 'registration_date',
                'format' => ['date', 'php:d.m.Y, H:i'],
                'value' => function ($model) {
                    return date('d.m.Y, H:i', strtotime($model->registration_date));
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->getStatusForReport();
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, EventRegistrations $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
