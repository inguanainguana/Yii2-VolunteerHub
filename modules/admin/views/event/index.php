<?php

use app\models\Event;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\EventSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Мероприятия';
?>
<div class="event-index mt-4">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить мероприятие', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'attribute' => 'description',
                'value' => function ($data) {
                    return $data->description ? (strlen($data->description) > 160 ? substr($data->description, 0, 160) . '...' : $data->description) : '';
                }
            ],
            [
                'attribute' => 'start_date',
                'format' => ['date', 'php:d.m.Y, H:i'],
                'value' => function ($model) {
                    return date('d.m.Y, H:i', strtotime($model->start_date));
                },
            ],
            [
                'attribute' => 'end_date',
                'format' => ['date', 'php:d.m.Y, H:i'],
                'value' => function ($model) {
                    return date('d.m.Y, H:i', strtotime($model->end_date));
                },
            ],
            'location',
            ['attribute' => 'image',
                'value' => function ($data) {
                    return $data->image ? (strlen($data->image) > 50 ? substr($data->image, 0, 30) . '...' : $data->image) : '';
                }
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return User::findOne($model->user_id)->getFullName();
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Event $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
