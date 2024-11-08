<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Создать оффер';
?>
<div class="offer-create container">
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Контейнер для вывода ошибок -->
    <div id="form-errors" class="alert alert-danger" style="display:none;"></div>

    <?php $form = ActiveForm::begin([
        'id' => 'offer-form',
        'action' => \yii\helpers\Url::to(['offer/create']),
        'enableAjaxValidation' => false,
    ]); ?>

    <?= $form->field($model, 'offer_name')->textInput(['maxlength' => true, 'placeholder' => 'Название оффера'])->error(false) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email представителя'])->error(false) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Телефон представителя (необязательно)']) ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
    var redirectUrl = '<?= \yii\helpers\Url::to(['index']) ?>';
</script>
