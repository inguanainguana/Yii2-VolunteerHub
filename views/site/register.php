<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Регистрация';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Присоединяйтесь к нашей команде волонтеров! Заполните форму регистрации, чтобы стать частью значимого события и внести свой вклад в улучшение общества. Ваше участие имеет значение!',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'регистрация, волонтерство, участие, социальные инициативы, форма регистрации, помощь обществу, события, активное участие, волонтерские проекты',
]);
?>
<div class="site-login mt-4">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

            <div class="row">

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                'inputOptions' => ['class' => 'col-lg-3 form-control'],
                'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
            ],
        ]); ?>

        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'surname')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'patronymic')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>


        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'phone_number')->widget(\yii\widgets\MaskedInput::class, [
    'mask' => '+7 (999) 999-99-99',]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'password_repeat')->passwordInput() ?>



            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"\">{error}</div>",
            ]) ?>

                <div class="form-group text-center">
                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

            </div>

            <?php ActiveForm::end(); ?>


        </div>
    </div>
</div>
