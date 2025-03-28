<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EventRegistrations $model */

$this->title = 'Зарегистрировать волонтера';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Зарегистрируйтесь на волонтерское мероприятие и станьте частью важной социальной инициативы! Присоединяйтесь к команде, чтобы вместе делать мир лучше.',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'регистрация на мероприятие, волонтерство, участие в мероприятиях, социальные инициативы, волонтерская регистрация, события, помощь обществу, активное участие, работа с сообществом',]);
?>
<div class="event-registrations-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
