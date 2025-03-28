<?php

namespace app\controllers;

use app\models\Follows;
use app\models\User;
use Yii;
use yii\web\NotFoundHttpException;

class FollowsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionProfile()
    {

        $user = Follows::find()->where(['user_id' => Yii::$app->user->identity->id])->all();

        $context =
            ['user' => $user];
        return $this->render('profile', $context);
    }

    public function actionManage($id)
    {
        $currentUserId = Yii::$app->user->id;

        if ($currentUserId === null) {
            return $this->redirect(['site/login']);
        }

        if ($currentUserId == $id) {
            throw new NotFoundHttpException('Вы не можете подписаться на себя.');
        }

        $follow = Follows::findOne(['user_id' => $currentUserId, 'followed_id' => $id]);

        if ($follow) {
            $follow->delete();
            Yii::$app->session->setFlash('success', 'Вы удалили пользователя из друзей.');
        } else {
            $newFollow = new Follows();
            $newFollow->user_id = $currentUserId;
            $newFollow->followed_id = $id;

            if ($newFollow->save()) {
                Yii::$app->session->setFlash('success', 'Вы подписались на пользователя.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при подписке.');
            }
        }

        // Перенаправляем обратно на профиль
        return $this->redirect(['site/profile', 'id' => $id]);
    }





}
