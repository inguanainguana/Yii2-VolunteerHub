<?php
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Список волонтерских мероприятий';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Найдите волонтерские мероприятия в вашем городе. Подберите возможности по интересам и доступности. Присоединяйтесь к сообществу волонтеров и вносите свой вклад в социальные проекты.',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'список мероприятий, волонтерство, возможности, помощь, социальные проекты, участие в мероприятиях, волонтерские инициативы, помощь сообществу, поиск волонтеров, мероприятия по интересам',
]);

?>
<h1 class="mt-4">Список волонтерских мероприятий</h1>
<div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
    <?php foreach ($event as $item): ?>
        <div class="col">
            <div class="card" style="width: 22rem;">
                <?= Html::img("@web/" . $item->image, ['class' => 'card-img-top', 'alt' => $item->title,  'style' => 'max-height: 230px; object-fit: cover; margin: auto; display: block;']) ?>
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