<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Reviews $model */

$this->title = 'Изменить отзыв на: "' . $model->event->title . '"';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Обновите свой отзыв на мероприятие "' . $model->event->title . '" на платформе VolunteerHub. Поделитесь своим опытом и помогите другим волонтерам.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'изменить отзыв, ' . $model->event->title . ', VolunteerHub, волонтерские мероприятия, отзывы, обновление, сообщество'
]);
?>

<div class="reviews-update mt-5">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
