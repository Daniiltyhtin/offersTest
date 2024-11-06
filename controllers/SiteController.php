<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;

class SiteController extends Controller
{
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;

        if ($exception !== null) {
            // Установка кода ошибки для заголовка
            $statusCode = $exception instanceof HttpException ? $exception->statusCode : 500;

            // Запись ошибки в логи (можно настроить по необходимости)
            Yii::error("Error {$statusCode}: {$exception->getMessage()}", __METHOD__);

            // Рендер представления ошибки с передачей данных об ошибке
            return $this->render('error', [
                'exception' => $exception,
                'statusCode' => $statusCode,
            ]);
        }

        // Если исключения нет, перенаправляем на главную страницу или страницу по умолчанию
        return $this->redirect(['index']);
    }
}
