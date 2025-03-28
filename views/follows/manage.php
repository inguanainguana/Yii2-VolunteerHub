<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $actionText string */
/* @var $buttonLabel string */
/* @var $follow bool */

$this->title = 'Подтверждение действия';
?>

<div class="confirm-action">
    <h1>Подтверждение действия</h1>
    <p>Вы действительно хотите <?= Html::encode($actionText) ?> на пользователя <?= Html::encode($user->username) ?>?</p>

    <form action="<?= Url::to(['follow/manage-confirm', 'id' => $user->id]) ?>" method="post">
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
        <button type="submit" class="btn btn-primary"><?= Html::encode($buttonLabel) ?></button>
        <a href="<?= Url::to(['profile', 'id' => $user->id]) ?>" class="btn btn-secondary">Отмена</a>
    </form>
</div>
