<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Профиль пользователя';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Профиль пользователя на платформе VolunteerHub. Узнайте больше о волонтерских инициативах, в которых участвует пользователь, и его вкладе в сообщество.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'VolunteerHub, волонтер, профиль волонтера, волонтерская деятельность, участие в мероприятиях, помощь сообществу, социальные проекты, волонтерские инициативы, координация волонтеров'
]);

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-4">
            <div class="card mb-3" style="height: 100%;">
                <div class="text-center" style="padding: 10px;">
                    <img src="img/2606889_6156.svg" alt="Дефолт аватар"
                         class="img-fluid rounded-circle"
                         style="max-height: 300px; object-fit: cover; margin: auto; display: block;">
                </div>
                <div class="card-body text-center">
                    <h5 class="my-3"><?= Html::encode($model->username) ?></h5>
                    <div class="d-flex justify-content-center mb-2">
                        <form action="<?= Url::to(['follows/manage', 'id' => $model->id]) ?>" method="post">
                            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken); ?>
                            <?php if ($currentUserId !== $model->id): ?>
                                <button type="submit" class="btn <?= $isFollowing ? 'btn-danger' : 'btn-primary' ?>">
                                    <?= $isFollowing ? 'Удалить из друзей' : 'Подружиться' ?>
                                </button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <h2 class="mb-4"><?= Html::encode($model->name) ?> <?= Html::encode($model->surname) ?></h2>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Контактная информация:</h5>
                    <p><span style="font-size: 1em;">📧</span> <?= Html::encode($model->email) ?></p>
                    <p><span style="font-size: 1em;">📞</span> <?= Html::encode($model->phone_number) ?></p>
                </div>
            </div>
        </div>
    </div>
    <h3 class="card-title mt-5">Мероприятия</h3>
    <?php if (!empty($createdEvents)): ?>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
            <?php foreach ($createdEvents as $event): ?>
                <div class="col">
                    <div class="card mt-2" style="width: 21rem;">
                        <?= Html::img("@web/" . $event->image, ['class' => 'card-img-top', 'alt' => $event->title, 'style' => 'max-height: 230px; object-fit: cover; margin: auto; display: block;']) ?>
                        <a class="card-action" href="<?= Url::to(['event/view', 'id' => $event->id]) ?>"
                           title="Помочь!">
                            <i class="fa fa-heart"></i>
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($event->title) ?></h5>
                            <p class="card-text">
                                <span style="font-size: 1.1em;">📝</span>
                                <span class="short-description"><?= mb_substr($event->description, 0, 140, 'UTF-8') ?>...</span>
                                <span class="full-description" style="display: none;"><?= $event->description ?></span>
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
                            <?= Html::a('Подробнее', ['event/view', 'id' => $event->id], ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Нет созданных мероприятий.</p>
    <?php endif; ?>
    <h3 class="mt-5">Мероприятия, на которые зарегистрированы:</h3>
    <?php if (!empty($registeredEvents)): ?>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($registeredEvents as $registration): ?>
                <?php if ($registration->event): ?>
                    <div class="col">
                        <div class="card" style="width: 21rem;">
                            <?= Html::img("@web/" . $registration->event->image, ['class' => 'card-img-top', 'alt' => $registration->event->title, 'style' => 'max-height: 230px; object-fit: cover; margin: auto; display: block;']) ?>
                            <a class="card-action"
                               href="<?= Url::to(['event/view', 'id' => $registration->event->id]) ?>" title="Помочь!">
                                <i class="fa fa-heart"></i>
                            </a>
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
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <p>Мероприятие не найдено.</p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Этот пользователь еще не зарегистрировался ни на одно мероприятие.</p>
    <?php endif; ?>

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