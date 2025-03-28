<?php

namespace app\controllers;

use app\models\ReviewsForm;
use Yii;

class ReviewsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new ReviewsForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['event/view', 'id' => $model->event_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

}
