<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Отчет об участии волонтеров';
$this->params['breadcrumbs'][] = ['label' => 'Отчеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Отчет по участию волонтеров</h1>
<table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
    <thead>
    <tr>
        <th style="padding: 10px; border: 1px solid transparent;">Имя</th>
        <th style="padding: 10px; border: 1px solid transparent;">Фамилия</th>
        <th style="padding: 10px; border: 1px solid transparent;">Отчество</th>
        <th style="padding: 10px; border: 1px solid transparent;">Мероприятие</th>
        <th style="padding: 10px; border: 1px solid transparent;">Дата регистрации</th>
        <th style="padding: 10px; border: 1px solid transparent;">Статус</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $registration): ?>
        <tr>
            <td style="padding: 10px; border: 1px solid transparent;"><?= Html::encode($registration->user->name) ?></td>
            <td style="padding: 10px; border: 1px solid transparent;"><?= Html::encode($registration->user->surname) ?></td>
            <td style="padding: 10px; border: 1px solid transparent;"><?= Html::encode($registration->user->patronymic) ?></td>
            <td style="padding: 10px; border: 1px solid transparent;"><?= Html::encode($registration->event->title) ?></td>
            <td style="padding: 10px; border: 1px solid transparent;"><?= Html::encode($registration->registration_date) ?></td>
            <td style="padding: 10px; border: 1px solid transparent;"><?= Html::encode($registration->getStatusForReport()) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
