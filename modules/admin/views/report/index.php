<?php

use yii\helpers\Html;

$this->title = 'Генерация отчетов';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Генерация отчетов в VolunteerHub. Выберите формат отчета: PDF или Excel, чтобы легко управлять данными о волонтерах и их активности.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'генерация отчетов, PDF отчет, Excel отчет, VolunteerHub, волонтеры, управление данными'
]);

?>

<div class="report-generation" style="text-align: center; padding: 40px;">
    <h1 class="mt-4" style="font-size: 2.5em;"><?= Html::encode($this->title) ?></h1>

    <p style="font-size: 1.2em; margin: 20px 0;">
        На этой странице вы можете сгенерировать отчеты о волонтерах в различных форматах. Выбор формата зависит от ваших нужд:
    </p>
    <ul style="list-style-type: none; padding: 0;">
        <li style="margin: 10px 0;">
            <strong>PDF отчет</strong> - идеален для печати и представления данных в удобном виде. Используйте этот формат, если вам нужно поделиться отчетом с коллегами или партнерами. 📄
        </li>
        <li style="margin: 10px 0;">
            <strong>Excel отчет</strong> - подходит для анализа данных и дальнейшей работы с ними. Выбирайте этот формат, если вам нужно провести глубокий анализ или создать визуализации. 📊
        </li>
    </ul>

    <p>
        <?= Html::a('Сгенерировать PDF отчет', ['generate-pdf'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сгенерировать Excel отчет', ['generate-excel'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
