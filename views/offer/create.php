<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Создать оффер';
?>
<div class="offer-create container">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Контейнер для вывода ошибок -->
    <div id="form-errors" class="alert alert-danger" style="display:none;"></div>

    <?php $form = ActiveForm::begin(['id' => 'offer-form','action' => \yii\helpers\Url::to(['offer/create']) ]); ?>

    <?= $form->field($model, 'offer_name')->textInput(['maxlength' => true, 'placeholder' => 'Название оффера']) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email представителя']) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Телефон представителя (необязательно)']) ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    console.log('Form action:', $(this).attr('action'));
    $(document).on('submit', '#offer-form', function (e) {
        e.preventDefault();
        console.log('sdasd');
        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: $(this).serialize(),
            success: function () {
                alert('Оффер успешно создан');
                window.location.href = '<?= \yii\helpers\Url::to(['offer/index']) ?>';
            },
            error: function (xhr, status, error) {
                console.log('Ошибка запроса:', xhr, status, error); // Проверка содержимого ошибки
                const errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                let errorHtml = '<ul>';

                if (errors) {
                    for (let field in errors) {
                        errors[field].forEach(error => {
                            errorHtml += `<li>${error}</li>`;
                        });
                    }
                } else {
                    errorHtml = '<li>Произошла ошибка. Попробуйте еще раз.</li>';
                }

                errorHtml += '</ul>';
                $('#form-errors').html(errorHtml).show();
            }

        });
    });
</script>