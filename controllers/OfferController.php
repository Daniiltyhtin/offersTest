<?php

namespace app\controllers;

use Yii;
use app\models\Offer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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
        // - фильтрация по имени оффера 
        if ($name = Yii::$app->request->get('offer_name')) {
            $query->andFilterWhere(['like', 'offer_name', $name]);
        }
        // - фильтрация по email оффера 
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
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    "success" => true,  // Если оффер успешно создан
                ];
            } else {
                Yii::$app->response->statusCode = 400; // Устанавливаем код ошибки
                return $this->asJson([
                    'errors' => $model->errors,
                ]);
            }

        }

        // Если это обычный запрос, возвращаем вид с ошибками
        return $this->render('create', [
            'model' => $model,
        ]);
    }




    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    "success" => true,  // Если оффер успешно создан
                ];
            } else {
                Yii::$app->response->statusCode = 400; // Устанавливаем код ошибки
                return $this->asJson([
                    'errors' => $model->errors,
                ]);
            }

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
