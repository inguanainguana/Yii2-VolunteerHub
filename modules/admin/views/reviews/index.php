<?php

use app\models\Event;
use app\models\Reviews;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ReviewsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Отзывы о мероприятиях VolunteerHub';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Читайте отзывы о мероприятиях, организованных через VolunteerHub. Узнайте мнения волонтеров и организаций о проведенных событиях и их влиянии на сообщество.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'отзывы о мероприятиях, VolunteerHub, волонтерские мероприятия, отзывы волонтеров, опыт участия, организация мероприятий, сообщество'
]);
?>

<div class="reviews-index mt-4">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Reviews $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
