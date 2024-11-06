<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Список офферов';
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="offer-search">
    <?= Html::beginForm(['offer/index'], 'get', ['id' => 'filter-form']) ?>
    <?= Html::textInput('name', Yii::$app->request->get('name'), ['placeholder' => 'Название оффера']) ?>
    <?= Html::textInput('email', Yii::$app->request->get('email'), ['placeholder' => 'Email представителя']) ?>
    <?= Html::submitButton('Фильтровать', ['class' => 'btn btn-primary']) ?>
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

<script>
    $(document).on('submit', '#filter-form', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'get',
            data: $(this).serialize(),
            success: function (data) {
                $('.grid-view').html($(data).find('.grid-view').html());
            }
        });
    });
</script>