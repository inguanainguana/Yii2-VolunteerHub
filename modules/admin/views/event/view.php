<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Event $model */

$this->title = $model->title;
$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'волонтёрство, благотворительность, помощь, социальные проекты, общественные инициативы, активизм, добрые дела, участие в жизни сообщества, поддержка нуждающихся']);

?>
<div class="event-view mt-4">

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
            'title',
            'description:ntext',
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
            'image',
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return User::findOne($model->user_id)->getFullName();
                },
            ],
        ],
    ]) ?>

</div>
