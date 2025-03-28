<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Создать мероприятие';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Создайте новое волонтерское мероприятие и привлечите участников! Опишите цели мероприятия, определите дату и место, а также делитесь своим опытом с сообществом волонтеров. Вдохновляйте других на участие в социальных инициативах и укрепляйте связи в вашем сообществе.',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'создание мероприятия, волонтерство, мероприятия, организация событий, привлечение участников, социальные инициативы, описание мероприятий, планирование волонтерских акций, вовлечение сообщества, обмен опытом',
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

</div>
    </div>
</div>