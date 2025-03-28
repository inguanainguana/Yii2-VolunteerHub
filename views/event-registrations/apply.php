<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventRegistrations */
/* @var $event app\models\Event */

$this->title = 'Регистрация на мероприятие';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Зарегистрируйтесь на волонтерское мероприятие и станьте частью важной социальной инициативы! Присоединяйтесь к команде, чтобы вместе делать мир лучше.',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'регистрация на мероприятие, волонтерство, участие в мероприятиях, социальные инициативы, волонтерская регистрация, события, помощь обществу, активное участие, работа с сообществом',]);
?>
<div class="site-login mt-4">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
            <div class="row text-center mt-4">
                <p class="card-text">Здравствуйте! 👋 Мы рады, что вы хотите присоединиться к мероприятию <strong><?= Html::encode($event->title) ?></strong>!</p>
                <p class="card-text">При регистрации вы соглашаетесь на использование ваших данных из учетной записи, чтобы организаторы могли знать своих участников.</p>
                <p class="card-text">После нажатия на кнопку "Подтвердить регистрацию" вы успешно зарегистрируетесь на это мероприятие. 🎉</p>
                <p class="card-text">На вашу электронную почту будет отправлено письмо с подтверждением регистрации и дополнительной информацией о мероприятии.</p>
            </div>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'event_id')->hiddenInput(['value' => $event->id])->label(false) ?>

            <div class="form-group text-center">
                <input type="checkbox" id="agree" name="agree" required>
                <label for="agree">Я согласен с правилами сайта и даю согласие на использование моих данных для мероприятия.</label>
            </div>


            <div class="form-group text-center">
                <?= Html::submitButton('Подтвердить регистрацию', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
