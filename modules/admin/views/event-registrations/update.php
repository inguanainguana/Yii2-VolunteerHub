<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EventRegistrations $model */

$this->title = 'Изменить: ' . $model->event->title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Измените регистрацию на волонтерское мероприятие и продолжайте вносить вклад в важные социальные проекты! Присоединяйтесь к команде и помогайте создавать позитивные изменения в обществе.',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'обновление регистрации, волонтерство, изменение данных, участие в волонтерских мероприятиях, социальные проекты, волонтерская деятельность, помощь обществу, активное участие, работа с сообществом, обновление информации',
]);
?>

?>
<div class="event-registrations-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
