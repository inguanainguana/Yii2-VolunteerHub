<?php

use app\models\Event;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Reviews $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="event-registrations-form mt-2">
    <div class="card">
        <div class="card-body">

            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
            <div class="row">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'event_id')->dropDownList(Event::find()->select('title')->indexBy('id')->column(), ['prompt' => 'Выберите мероприятие']) ?>

                <?= $form->field($model, 'user_id')->dropDownList(User::find()->select('username')->indexBy('id')->column(), ['prompt' => 'Выберите пользователя']) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'rating')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'created_at')->textInput() ?>

                <?= $form->field($model, 'is_active')->textInput() ?>

                <div class="form-group text-center">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>