// функция для создания офферов
$(document).ready(function () {
    $('#offer-form').on('submit', function (e) {
        e.preventDefault();

        var $form = $(this);
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function (response) {
                if (response.success) {
                    alert('Оффер успешно создан');
                    window.location.href = '/offers'; // Перенаправление на страницу с офферами
                } else {
                    $('#form-errors').html('<ul><li>Произошла ошибка. Попробуйте еще раз.</li></ul>').show(); // Показать ошибку
                }
            },
            // - обработка ошибок
            error: function (xhr, status, error) {
                console.log('Ошибка запроса:', xhr, status, error);
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
                $('#form-errors').html(errorHtml).show(); // Показываем ошибки
            }
        });

        return false;
    });
});

$(document).ready(function () {
    $('#offer-update').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: $(this).serialize(),
            success: function () {
                alert('Оффер успешно обновлен');
                window.location.href = '/offers'; // Перенаправление на страницу с офферами
            },
            // - обработка ошибок
            error: function (xhr, status, error) {
                console.log('Ошибка запроса:', xhr, status, error);
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
    })
});

// Функции для фильтрации офферов
// Смотри  Offer actionIndex
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
