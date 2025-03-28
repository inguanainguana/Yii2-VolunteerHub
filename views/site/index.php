<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Главная';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'VolunteerHub – это платформа для координации волонтерской деятельности, связывающая организации и волонтеров. Найдите возможности для помощи, организуйте волонтерские мероприятия и управляйте ими.',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'VolunteerHub, волонтерство, мероприятия, организация волонтерской деятельности, поиск волонтеров, помощь сообществу, участие в социальных проектах, создание мероприятий, волонтерские инициативы, регистрация волонтеров',
]);

?>

<div class="site-index mt-4">

    <div class="hero">
        <img src="img/Volunteering-charity-social-concept.-Volunteer-people-plant-trees-in-city-park-vector-flat-illustration.-Ecological-lifestyle.jpg" alt="Баннер с волонтерами">
        <div class="hero-content">
            <h1>Добро пожаловать в VolunteerHub!</h1>
            <p>VolunteerHub – это платформа для координации волонтерской деятельности, связывающая организации и волонтеров.</p>
            <p>
                <a class="btn btn-lg btn-primary" data-toggle="modal" data-target="#volunteerModal">Начать</a>
            </p>
        </div>
        <div class="modal fade" id="volunteerModal" tabindex="-1" role="dialog" aria-labelledby="volunteerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border-radius: 15px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);">
                    <div class="modal-header text-center" style="width: 100%;">
                        <h4 class="modal-title mx-auto" id="volunteerModalLabel">Регистрация</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 15px; background: none; border: none; font-size: 1.5rem; color: #646464;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="font-size: 1.2rem; line-height: 1.5;">
                        <h5>Обещание волонтера</h5>
                        <p>Я, волонтер VolunteerHub, с радостью обещаю:</p>
                        <ol style="list-style-type: none; padding-left: 0;">
                            <li style="position: relative; padding-left: 20px; margin-bottom: 10px;">
                                <span style="position: absolute; left: 0; top: 0; color: #20B2AA;">✓</span>
                                Выбирать проекты, соответствующие моим навыкам и интересам;
                            </li>
                            <li style="position: relative; padding-left: 20px; margin-bottom: 10px;">
                                <span style="position: absolute; left: 0; top: 0; color: #20B2AA;">✓</span>
                                Ответственно выполнять свои обязательства и завершать начатое;
                            </li>
                            <li style="position: relative; padding-left: 20px; margin-bottom: 10px;">
                                <span style="position: absolute; left: 0; top: 0; color: #20B2AA;">✓</span>
                                Поддерживать открытое общение с организациями и сообщать о любых изменениях в своих планах;
                            </li>
                        </ol>
                        <p>Ваш вклад имеет значение! Вместе мы можем изменить мир к лучшему! 🌟🤝</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <a class="btn btn-primary" href="<?= Url::to(['site/register']) ?>">Продолжить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="container mt-5">
        <h2 class="text-center">Преимущества VolunteerHub</h2>
        <div class="row">
            <div class="col-md-4 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title"><span style="font-size: 1.1em;">🖥️</span> Легкость использования</h5>
                        <p class="card-text">Удобный интерфейс и простая навигация помогут вам сосредоточиться на помощи другим людям всегда.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title"><span style="font-size: 1.1em;">🌍</span> Широкий выбор проектов</h5>
                        <p class="card-text">На нашей платформе вы найдете множество проектов, соответствующих вашим интересам и навыкам.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title"><span style="font-size: 1.1em;">🤝</span> Поддержка сообщества</h5>
                        <p class="card-text">Присоединяйтесь к сообществу единомышленников и получайте поддержку от других волонтеров.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <h3 class="mt-5">Добрые дела рядом с вами</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
        <?php foreach ($event as $item): ?>
            <div class="col">
                <div class="card" style="width: 22rem;">
                    <?= Html::img("@web/" . $item->image, ['class' => 'card-img-top', 'alt' => $item->title, 'style' => 'max-height: 230px; object-fit: cover; margin: auto; display: block;']) ?>
                    <a class="card-action" href="<?= Url::to(['event/view', 'id' => $item->id]) ?>" title="Помочь!">
                        <i class="fa fa-heart"></i>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?= $item->title ?></h5>
                        <p class="card-text">
                            <span style="font-size: 1.1em;">📝</span>
                            <span class="short-description"><?= mb_substr($item->description, 0, 140, 'UTF-8') ?>...</span>
                            <span class="full-description" style="display: none;"><?= $item->description ?></span>
                            <button class="btn btn-link toggle-description"
                                    style="cursor: pointer; display: inline-block; margin-left: 5px; padding: 0;">Продолжить
                            </button>
                        </p>
                        <p class="card-text">
                            <span style=" font-size: 1.1em;">📍</span> <?= $item->location ?>
                        </p>
                        <p class="card-text">
                            <span style="  font-size: 1.1em;">🕒</span> <?= date('d.m.Y, H:i', strtotime($item->start_date)) ?>
                            - <?= date('d.m.Y, H:i', strtotime($item->end_date)) ?>
                        </p>
                        <?= Html::a('Подробнее', ['event/view', 'id' => $item->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="col">
            <div class="card" style="width: 22rem; text-align: center; background-color: #fff;">
                <img src="icons8-волонтерство-100.png" class="card-img-top" style="height: 230px; object-fit: cover;" alt="Иконка волонтера">
                <div class="card-body">
                    <h5 class="card-title">Ещё <?= count($event) ?> дел доступны в нашей платформе</h5>
                    <p class="card-text">Посмотрите все мероприятия на нашей платформе!</p>
                    <?= Html::a('Смотреть все', ['event/index'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <script>
        document.querySelectorAll('.toggle-description').forEach(button => {
            button.addEventListener('click', function () {
                const parentParagraph = this.parentElement;
                const fullDescription = parentParagraph.querySelector('.full-description');
                const shortDescription = parentParagraph.querySelector('.short-description');

                if (fullDescription.style.display === 'none') {
                    fullDescription.style.display = 'inline';
                    shortDescription.style.display = 'none';
                    this.textContent = 'Скрыть';
                } else {
                    fullDescription.style.display = 'none';
                    shortDescription.style.display = 'inline';
                    this.textContent = 'Продолжить';
                }
            });
        });
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
