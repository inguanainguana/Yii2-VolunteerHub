<?php

use yii\helpers\Html;

$this->title = 'Админ панель VolunteerHub';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'VolunteerHub - платформа для координации волонтерской деятельности, связывающая организации и волонтеров. Управляйте активностью волонтеров и генерируйте отчеты с легкостью.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'волонтеры, координация волонтерской деятельности, VolunteerHub, отчеты, управление волонтерами, сообщество' ]);
?>
<div class="site-index mt-4">

    <div class="hero">
        <img src="img/posadka-sazhentsev.jpg" alt="Изображение волонтера" class="img-fluid">
        <div class="hero-content">
            <h1>Добро пожаловать в VolunteerHub!</h1>
            <p>Вы находитесь в <strong>панели администратора, </strong> где вы можете координировать волонтерскую деятельность
                и связывать организации с волонтерами. Ваша работа важна для создания сообщества! 🌍 <br>
            Чтобы облегчить вашу работу, вы можете сгенерировать отчеты по участию и активности волонтеров всего в один клик. <br>
            </p>
            <?= Html::a('Сгенерировать отчёт', ['report/index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

</div>
