<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $createdEvents app\models\Event[] */
/* @var $registeredEvents app\models\EventRegistrations[] */

$this->title = 'Личный кабинет';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Добро пожаловать в ваш личный кабинет! Управляйте своими мероприятиями, на которые вы зарегистрировались, и следите за новыми волонтерскими событиями. Получайте уведомления о новых возможностях, общайтесь с другими волонтёрами и участвуйте в жизни сообщества.',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'личный кабинет, управление мероприятиями, волонтерство, уведомления о мероприятиях, взаимодействие с волонтерами, организация волонтерских активностей, сообщество волонтёров, новые возможности, участие в событиях',
]);
?>
    <div class="container mt-4">
        <h2 class="text-center">Добро пожаловать в ваш личный кабинет! 🎉</h2>
        <p class="text-center">Здесь вы можете управлять своими созданными мероприятиями и просматривать те, на которые
            вы зарегистрировались.</p>

        <h3 class="d-flex justify-content-between align-items-center">
            Созданные вами мероприятия:
            <?= Html::a('Создать мероприятие', ['event/create'], ['class' => 'btn btn-primary']) ?>
        </h3>
        <?php if (!empty($createdEvents)): ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($createdEvents as $event): ?>
                    <div class="col">
                        <div class="card" style="width: 21rem;">
                            <?= Html::img("@web/" . $event->image, ['class' => 'card-img-top', 'alt' => $event->title, 'style' => 'max-height: 230px; object-fit: cover; margin: auto; display: block;']) ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= Html::encode($event->title) ?></h5>
                                <p class="card-text">
                                    <span style="font-size: 1.1em;">📝</span>
                                    <span class="short-description"><?= mb_substr(Html::encode($event->description), 0, 140, 'UTF-8') ?>...</span>
                                    <span class="full-description"
                                          style="display: none;"><?= Html::encode($event->description) ?></span>
                                    <button class="btn btn-link toggle-description"
                                            style="cursor: pointer; display: inline-block; margin-left: 5px; padding: 0;">
                                        Продолжить
                                    </button>
                                </p>
                                <p class="card-text">
                                    <span style="font-size: 1.1em;">📍</span> <?= Html::encode($event->location) ?>
                                </p>
                                <p class="card-text">
                                    <span style="font-size: 1.1em;">🕒</span> <?= date('d.m.Y, H:i', strtotime($event->start_date)) ?>
                                    - <?= date('d.m.Y, H:i', strtotime($event->end_date)) ?>
                                </p>
                                <?= Html::a('Изменить', ['event/update', 'id' => $event->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a('Удалить', ['event/delete', 'id' => $event->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить это мероприятие?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Вы еще не создали ни одного мероприятия.</p>
        <?php endif; ?>

        <h3 class="mt-4">Мероприятия, на которые вы зарегистрировались:</h3>
        <?php if (!empty($registeredEvents)): ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($registeredEvents as $registration): ?>
                    <?php if ($registration->event): ?>
                        <div class="col">
                            <div class="card" style="width: 21rem;">
                                <?= Html::img("@web/" . $registration->event->image, ['class' => 'card-img-top', 'alt' => $registration->event->title]) ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?= Html::encode($registration->event->title) ?></h5>
                                    <p class="card-text">
                                        <span style="font-size: 1.1em;">📝</span>
                                        <span class="short-description"><?= mb_substr(Html::encode($registration->event->description), 0, 140, 'UTF-8') ?>...</span>
                                        <span class="full-description"
                                              style="display: none;"><?= Html::encode($registration->event->description) ?></span>
                                        <button class="btn btn-link toggle-description"
                                                style="cursor: pointer; display: inline-block; margin-left: 5px; padding: 0;">
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
                                    <p class="card-text">
                                        <?= $registration->getStatus(); ?>
                                    </p>

                                    <?= Html::a('Подробнее', ['event/view', 'id' => $registration->event->id], ['class' => 'btn btn-primary']) ?>
                                    <?= Html::a('Отменить', ['event-registrations/delete', 'id' => $registration->id], [
                                        'class' => 'btn btn-warning',
                                        'data' => [
                                            'confirm' => 'Вы уверены, что хотите отменить свою регистрацию на это мероприятие?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <p>Мероприятие не найдено.</p>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Вы еще не зарегистрировались ни на одно мероприятие.</p>
        <?php endif; ?>

    </div>

<?php
$this->registerJs(
    "
    document.querySelectorAll('.toggle-description').forEach(button => {
        button.addEventListener('click', function() {
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
    "
);
?>