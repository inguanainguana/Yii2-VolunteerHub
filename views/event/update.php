<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventForm */
/* @var $form yii\widgets\ActiveForm */


$this->title = 'Изменить мероприятие';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Обновите информацию о вашем волонтерском мероприятии. Внесите изменения в дату, время, место и описание, чтобы обеспечить актуальность данных для участников. Поддерживайте связь с волонтёрами и делитесь важной информацией о предстоящих событиях, чтобы они были всегда в курсе.',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'изменить мероприятие, обновление информации, волонтерство, управление мероприятиями, редактирование событий, актуализация данных, планирование волонтерских акций, вовлечение волонтёров, организация мероприятий, эффективное взаимодействие',
]);

?>

<div class="site-login mt-4">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

            <div class="row">

                <?php $form = ActiveForm::begin([
                    'id' => 'register-form',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3'],
                        'inputOptions' => ['class' => 'col-lg-2 form-control'],
                        'errorOptions' => ['class' => 'col-lg-8 invalid-feedback'],
                    ],
                    'options' => ['enctype' => 'multipart/form-data']
                ]); ?>


                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'start_date')->textInput(['placeholder' => 'dd.mm.yyyy HH:mm']) ?>

                <?= $form->field($model, 'end_date')->textInput(['placeholder' => 'dd.mm.yyyy HH:mm']) ?>

                <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'image')->fileInput(); ?>


                <div class="form-group text-center">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                </div>



    <?php ActiveForm::end(); ?>

</div>