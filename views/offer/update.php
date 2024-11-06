<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Редактировать оффер: ' . $model->offer_name;
?>
<div class="offer-update container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'offer-form']); ?>

    <?= $form->field($model, 'offer_name')->textInput(['maxlength' => true, 'placeholder' => 'Название оффера']) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email представителя']) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Телефон представителя (необязательно)']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $(document).on('submit', '#offer-form', function (e) {
        e.preventDefault();

        let isValid = true;
        const nameField = $('#offer-name');
        const emailField = $('#offer-email');

        if (nameField.val().trim() === '') {
            isValid = false;
            alert('Название оффера обязательно для заполнения.');
        }

        if (!isValidEmail(emailField.val())) {
            isValid = false;
            alert('Введите корректный email.');
        }

        if (isValid) {
            this.submit();
        }
    });

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
</script>