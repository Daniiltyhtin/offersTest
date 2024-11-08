<?php

use yii\helpers\Html;
use yii\grid\GridView;
 
$this->title = 'Список офферов';
?>
<h1><?= Html::encode($this->title) ?></h1>


<div class="offer-search">
    <?= Html::beginForm(['offer/index'], 'get', ['id' => 'filter-form']) ?>
    <?= Html::textInput('offer_name', Yii::$app->request->get('offer_name'), ['placeholder' => 'Название оффера']) ?>
    <?= Html::textInput('email', Yii::$app->request->get('email'), ['placeholder' => 'Email представителя']) ?>
    <?= Html::submitButton('Фильтровать', ['class' => 'button btn-filter']) ?>
    <?= Html::endForm() ?>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'offer_name',
        'email',
        'phone',
        'created_at',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
        ],
    ],
]); ?>

