<?php

namespace app\modules\admin\controllers;

use app\models\EventRegistrations;
use app\models\EventRegistrationsSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventRegistrationsController implements the CRUD actions for EventRegistrations model.
 */
class EventRegistrationsController extends Controller
{
    public $layout = 'main';

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'view', 'create', 'update'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->is_admin == 1;
                        },
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update'],
                        'allow' => false,
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all EventRegistrations models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EventRegistrationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EventRegistrations model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EventRegistrations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new EventRegistrations();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $registrationDateTime = \DateTime::createFromFormat('d.m.Y, H:i', $model->registration_date);

                if ($registrationDateTime) {
                    $model->registration_date = $registrationDateTime->format('Y-m-d H:i:s');

                    if ($model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    $model->addError('registration_date', 'Неверный формат даты регистрации.');
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing EventRegistrations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            // Загружаем данные из POST-запроса
            if ($model->load($this->request->post())) {
                $registrationDateTime = \DateTime::createFromFormat('d.m.Y, H:i', $model->registration_date);

                if ($registrationDateTime) {
                    // Присваиваем отформатированную дату регистрации
                    $model->registration_date = $registrationDateTime->format('Y-m-d H:i:s');

                    // Сохраняем модель
                    if ($model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    // Добавляем ошибку, если формат даты неверный
                    $model->addError('registration_date', 'Неверный формат даты регистрации.');
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing EventRegistrations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EventRegistrations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return EventRegistrations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventRegistrations::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
