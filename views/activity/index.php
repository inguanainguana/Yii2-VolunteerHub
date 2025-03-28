<?php
$this->title = 'Лента активности';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Следите за последними событиями и инициативами на платформе VolunteerHub. Узнайте о новых волонтерских возможностях, мероприятиях и активности, которые помогут вам внести вклад в сообщество.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'VolunteerHub, лента активности, волонтерские мероприятия, новые инициативы, участие в волонтерстве, события, помощь сообществу, социальные проекты, волонтерские возможности, обновления'
]);

?>
<div class="site-index mt-4">

    <div class="hero">
        <img src="img/647874552d5db.jpg"
             alt="Баннер с единомышленниками" class="img-fluid">
        <div class="hero-content">
            <h1>Лента активности</h1>
            <p>Подружитесь с волонтерами на платформе VolunteerHub и следите за событиями, в которых они участвуют. Это
                уникальная возможность не только быть в курсе последних инициатив, но и активно присоединиться к ним,
                внося свой вклад в развитие сообщества. <br> Вместе мы можем изменить мир к лучшему!</p>
        </div>
    </div>
</div>
<div class="container mt-5">
    <?php use yii\helpers\Html;
    use yii\helpers\Url;

    if (!empty($friendsEvents)): ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
            <?php foreach ($friendsEvents as $registration): ?>
                    <div class="card shadow-sm mx-auto mt-4" style="width: 100%;">
                        <?= Html::img("@web/" . $registration->event->image, ['class' => 'card-img-top', 'alt' => $registration->event->title]) ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($registration->event->title) ?></h5>
                            <p class="card-text">
                                <span style="font-size: 1.1em;">📝</span>
                                <span class="short-description"><?= mb_substr($registration->event->description, 0, 140, 'UTF-8') ?>...</span>
                                <span class="full-description" style="display: none;"><?= $registration->event->description ?></span>
                                <button class="btn btn-link toggle-description" style="cursor: pointer; display: inline-block; margin-left: 5px; padding: 0;">
                                    Продолжить
                                </button>
                            </p>
                            <p class="card-text">
                                <span style="font-size: 1.1em;">📍</span> <?= Html::encode($registration->event->location) ?>
                            </p>
                            <p class="card-text">
                                <span style="font-size: 1.1em;">🕒</span> <?= date('d.m.Y, H:i', strtotime($registration->event->start_date)) ?>
                                - <?= date('d.m.Y, H:i', strtotime($registration->event->end_date)) ?>
                            </p>
                            <?= Html::a('Подробнее', ['event/view', 'id' => $registration->event->id], ['class' => 'btn btn-primary']) ?>
                        </div>
                        <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <span class="mr-2">👤</span>
                                <?= Html::a(Html::encode($registration->user->username), ['site/profile', 'id' => $registration->user->id], ['class' => 'font-weight-bold text-decoration-none']) ?>
                            </div>
                            <span>
                                Регистрация: <?= date('d.m.Y, H:i', strtotime($registration->registration_date)) ?>
                            </span>
                        </div>
                    </div>

            <?php endforeach; ?>
        </div>
        </div>
    <?php else: ?>
        <div class="alert alert-success text-center" role="alert">
            У вас либо нет друзей, либо ваши друзья не зарегистрировались на какое-либо мероприятие. 😊
        </div>
    <?php endif; ?>
</div>


<h3 class="mt-5">Рекомендуемые мероприятия</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
            <?php if (!empty($recommendedEvents)): ?>
                <?php foreach ($recommendedEvents as $event): ?>
                    <div class="col">
                        <div class="card" style="width: 21rem;">
                            <?= Html::img("@web/" . $event->image, ['class' => 'card-img-top', 'alt' => $event->title, 'style' => 'max-height: 230px; object-fit: cover; margin: auto; display: block;']) ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $event->title ?></h5>
                                <p class="card-text"><?= mb_substr($event->description, 0, 140, 'UTF-8') ?>...</p>
                                <p class="card-text">📍 <?= $event->location ?></p>
                                <p class="card-text">🕒 <?= date('d.m.Y, H:i', strtotime($event->start_date)) ?>
                                    - <?= date('d.m.Y, H:i', strtotime($event->end_date)) ?></p>
                                <?= Html::a('Подробнее', ['event/view', 'id' => $event->id], ['class' => 'btn btn-primary']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-warning text-center" role="alert">
                    Нет рекомендованных мероприятий.
                </div>
            <?php endif; ?>
            <div class="col">
                <div class="card" style="width: 21rem; text-align: center; background-color: #fff;">
                    <img src="icons8-волонтерство-100.png" class="card-img-top" alt="Иконка волонтера"
                         style="height: 230px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Ещё <?= $totalEventsCount ?> мероприятий доступны!</h5>
                        <p class="card-text">Посмотрите все мероприятия на нашей платформе!</p>
                        <?= Html::a('Смотреть все', ['event/index'], ['class' => 'btn btn-primary']) ?>
                    </div>
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