<?php

use app\models\Event;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\EventRegistrations $model */

$this->title = $model->event->title;
$this->registerMetaTag(['name' => 'description', 'content' => $model->event->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'волонтёрство, благотворительность, помощь, социальные проекты, общественные инициативы, активизм, добрые дела, участие в жизни сообщества, поддержка нуждающихся']);
?>
<div class="event-registrations-view mt-4">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
