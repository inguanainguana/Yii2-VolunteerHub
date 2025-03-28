<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $event app\models\Event */
/* @var $user app\models\User */

$this->title = $event->title;

$this->registerMetaTag(['name' => 'description', 'content' => $event->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'волонтёрство, благотворительность, помощь, социальные проекты, общественные инициативы, активизм, добрые дела, участие в жизни сообщества, поддержка нуждающихся']);

?>

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-4">
            <div class="card mb-3" style="height: 100%;">
                <div class="text-center" style="padding: 10px;">
                    <?= Html::img("@web/" . $event->image, [
                        'class' => 'img-fluid rounded',
                        'alt' => 'Изображение мероприятия',
                        'style' => 'max-height: 350px; object-fit: cover; margin: auto; display: block;'
                    ]) ?>
                </div>
                <div class="card-body text-center">
                    <?php
                    $eventDate = new DateTime($event->end_date);
                    $currentDate = new DateTime();
                    $isCreator = Yii::$app->user->id === $event->user_id;
                    ?>

                    <?php if ($eventDate < $currentDate): ?>
                        <button class=" btn btn-danger" disabled>Мероприятие больше недоступно</button>
                    <?php else: ?>
                        <?php if ($isCreator): ?>
                            <!--  Добавьте сюда контент, который хотите отображать для создателя мероприятия, если необходимо -->
                        <?php else: ?>
                            <?php if (Yii::$app->user->isGuest): ?>
                                <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#registrationModal">Подать
                                    Заявку</a>
                                <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog"
                                     aria-labelledby="registrationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content"
                                             style="border-radius: 15px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);">
                                            <div class="modal-header text-center" style="width: 100%;">
                                                <h4 class="modal-title mx-auto" id="registrationModalLabel">Регистрация</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                        style="position: absolute; right: 15px; background: none; border: none; font-size: 1.5rem; color: #646464;">
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
                                                        Поддерживать открытое общение с организациями и сообщать о любых
                                                        изменениях в своих планах;
                                                    </li>
                                                </ol>
                                                <p>Ваш вклад имеет значение! Вместе мы можем изменить мир к лучшему! 🌟🤝</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <a class="btn btn-primary"
                                                   href="<?= Url::to(['site/register']) ?>">Продолжить</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <a href="<?= Url::to(['event-registrations/apply', 'id' => $event->id]) ?>"
                                   class="btn btn-primary btn-lg">Подать Заявку</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <h2 class="mb-4"><?= Html::encode($event->title) ?></h2>
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Адрес:</h5>
                            <p>
                                <span style="font-size: 1em;">📍</span> <?= $event->location ?>
                            </p>
                            <h5 class="card-title">Время проведения:</h5>
                            <p>
                                <span style="font-size: 1em;">🕒</span> <?= date('d.m.Y, H:i', strtotime($event->start_date)) ?>
                                - <?= date('d.m.Y, H:i', strtotime($event->end_date)) ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Контактная информация:</h5>
                            <p>
                                <span style="font-size: 1em;">📧</span> <?= Html::encode($event->user->email) ?>
                            </p>
                            <p>
                                <span style="font-size: 1em;">📞</span> <?= Html::encode($event->user->phone_number) ?>
                            </p>
                            <span style="font-size: 1em;">👤</span> <?= Html::a(Html::encode($event->user->username), ['site/profile', 'id' => $event->user->id]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Описание:</h5>
                    <p>
                        <span style="font-size: 1em;">📝</span>
                        <?= Html::encode($event->description) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <h3 class="mt-5">Оставить отзыв</h3>
    <div class="reviews-form mb-4">
        <?php $form = ActiveForm::begin(); ?>
        <div class="rating-container mb-3">
            <div class="rating-area">
                <input type="radio" id="star-5" name="rating" value="5">
                <label for="star-5" title="Оценка «5»" class="star">★</label>
                <input type="radio" id="star-4" name="rating" value="4">
                <label for="star-4" title="Оценка «4»" class="star">★</label>
                <input type="radio" id="star-3" name="rating" value="3">
                <label for="star-3" title="Оценка «3»" class="star">★</label>
                <input type="radio" id="star-2" name="rating" value="2">
                <label for="star-2" title="Оценка «2»" class="star">★</label>
                <input type="radio" id="star-1" name="rating" value="1">
                <label for="star-1" title="Оценка «1»" class="star">★</label>
            </div>
            <?= $form->field($model, 'rating')->hiddenInput(['id' => 'rating-mark'])->label(false) ?>
        </div>

        <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Ваш отзыв') ?>

        <?php if (Yii::$app->user->isGuest): ?>
            <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#registrationModal">Сохранить</a>
            <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog"
                 aria-labelledby="registrationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content"
                         style="border-radius: 15px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);">
                        <div class="modal-header text-center" style="width: 100%;">
                            <h4 class="modal-title mx-auto" id="registrationModalLabel">Регистрация</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    style="position: absolute; right: 15px; background: none; border: none; font-size: 1.5rem; color: #646464;">
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
                                    Поддерживать открытое общение с организациями и сообщать о любых
                                    изменениях в своих планах;
                                </li>
                            </ol>
                            <p>Ваш вклад имеет значение! Вместе мы можем изменить мир к лучшему! 🌟🤝</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <a class="btn btn-primary"
                               href="<?= Url::to(['site/register']) ?>">Продолжить</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php endif; ?>


        <?php ActiveForm::end(); ?>
    </div>
</div>

<h3>Отзывы</h3>
<div class="reviews-list">
    <?php if (empty($reviews)): ?>
        <p>Нет отзывов? Вы можете быть первым, кто оставит его! </p>
    <?php else: ?>
        <?php foreach ($reviews as $review): ?>
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title"><?= Html::encode($review->user->username) ?></h5>
                    <?php
                    $rating = $review->rating;
                    for ($i = 1; $i <= 5; $i++):
                        $starClass = ($i <= $rating) ? 'active' : '';
                        ?>
                        <span class="star <?= $starClass ?>">★</span>
                    <?php endfor; ?>

                    <h6 class="card-subtitle mb-2 text-muted"><?= date('d.m.Y, H:i', strtotime($review->created_at)) ?></h6>
                    <p class="card-text"><?= Html::encode($review->description) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.rating-area input[type="radio"]').click(function () {
            var selectedRating = $(this).val();
            $('#rating-mark').val(selectedRating);
            console.log("Selected rating: " + selectedRating);
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>



