<?php

namespace app\controllers;

use Yii;
use app\models\Offer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class OfferController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Offer::find();

        if ($name = Yii::$app->request->get('name')) {
            $query->andFilterWhere(['like', 'name', $name]);
        }

        if ($email = Yii::$app->request->get('email')) {
            $query->andFilterWhere(['like', 'email', $email]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy(['id' => SORT_ASC]),
            'pagination' => ['pageSize' => 10],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Offer();
    
        // Загружаем данные из запроса и пытаемся сохранить модель
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Оффер успешно создан.');
            return $this->redirect(['index']);
        }
    
        // Если это AJAX-запрос, возвращаем ошибки в формате JSON
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->statusCode = 400; // Устанавливаем код ошибки
            return $this->asJson([
                'errors' => $model->errors,
            ]);
        }
    
        // Если это обычный запрос, возвращаем вид с ошибками
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Оффер успешно обновлен.');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Оффер успешно удален.');
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Offer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемый оффер не найден.');
    }
}
