<?php

use app\models\Event;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Reviews $model */

$this->title = $model->event->title;
\yii\web\YiiAsset::register($this);
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Узнайте больше о мероприятии "' . $model->event->title . '" на платформе VolunteerHub. Читайте детали, отзывы участников и информацию о том, как принять участие.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'мероприятие, ' . $model->event->title . ', VolunteerHub, волонтерские мероприятия, отзывы, участие, сообщество'
]);
?>
<div class="reviews-view mt-4">

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
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return User::findOne($model->user_id)->getFullName();
                },
            ],
            ['attribute' => 'event_id',
                'value' => function ($model) {

                    $event = Event::findOne($model->event_id);
                    return $event ? $event->title : 'Не найдено';
                },
            ],
            'description:ntext',
            'rating',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y, H:i'],
                'value' => function ($model) {
                    return date('d.m.Y, H:i', strtotime($model->created_at));
                },
            ],
            'is_active',
        ],
    ]) ?>

</div>
