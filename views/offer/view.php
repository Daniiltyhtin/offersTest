<?php
use yii\helpers\Html;

$this->title = 'Просмотр оффера: ' . $model->offer_name;
?>
<div class="offer-view container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><strong>ID:</strong> <?= Html::encode($model->id) ?></p>
    <p><strong>Название оффера:</strong> <?= Html::encode($model->offer_name) ?></p>
    <p><strong>Email представителя:</strong> <?= Html::encode($model->email) ?></p>
    <p><strong>Телефон представителя:</strong> <?= Html::encode($model->phone ?? 'Не указан') ?></p>
    <p><strong>Дата добавления:</strong> <?= Html::encode($model->created_at) ?></p>

    <div class="form-group">
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот оффер?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

</div>
