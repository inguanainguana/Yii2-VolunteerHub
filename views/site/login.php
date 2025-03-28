<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Войти';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Войдите в свою учетную запись, чтобы получить доступ к своим волонтерским проектам и событиям. Присоединяйтесь к нам в создании изменений и помощи обществу!',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'авторизация, вход, учетная запись, волонтерство, доступ к проектам, социальные инициативы, волонтерские события, помощь обществу',
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

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"\">{error}</div>",
                ]) ?>

                <div class="form-group text-center">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
