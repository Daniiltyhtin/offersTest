<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Редактировать оффер: ' . $model->offer_name;
?>
<div class="offer-update container">

    <h1><?= Html::encode($this->title) ?></h1>
    <!-- Контейнер для вывода ошибок -->
    <div id="form-errors" class="alert alert-danger" style="display:none;"></div>
    <!-- Форма -->
    <?php $form = ActiveForm::begin(['id' => 'offer-update']); ?>

    <?= $form->field($model, 'offer_name')->textInput(['maxlength' => true, 'placeholder' => 'Название оффера'])->error(false) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email представителя'])->error(false) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Телефон представителя (необязательно)']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить изменения', ['class' => 'button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

