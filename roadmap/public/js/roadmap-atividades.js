$(document).ready(function () {

    $("input[coluna=percentual_real]").on('blur', function () {

        if ($(this).val() > 0 && Date.parse($(this).parents(".form-group.row").find("input[coluna=data_inicio_proj]").val()) > new Date()) {

            alert('Uma atividade com início em data futura não pode ter percentual maior que 0. Ajuste a data de início.');

            $(this).val(0);

        } else {

            if ($(this).val() == 100) {

                let date = new Date();

                date = new Date(date.getTime() - (date.getTimezoneOffset() * 60000))
                    .toISOString()
                    .split("T")[0];

                $(this).parents(".form-group.row").find("input[coluna=data_fim_proj]").val(date);

                $(this).parents(".form-group.row").find("input[coluna=data_fim_proj]").addClass('is-invalid');

                $(this).addClass('is-invalid');

            } else if ($(this).val() == 0) {

                $(this).addClass('is-invalid');

            } else {

                let dados = new Object();

                dados.percentual = $(this).val();

                dados.data_inicio = $(this).parents(".form-group.row").find("input[coluna=data_inicio_proj]").val();

                dados.recurso_id = $(this).parents(".form-group.row").find("input[coluna=recurso_real_id]").val();

                dados.atividade_id = $(this).attr('atividade');

                dados.roadmap_id = null;

                let r = ajaxRequest(dados, '/ajax/calculardatas');

                $(this).addClass('is-invalid');

                $.when(r).done(function (response) {

                    $("input[atividade=" + response.resultado['id'] + "][coluna=data_fim_proj]").siblings("span").remove();

                    $("input[atividade=" + response.resultado['id'] + "][coluna=data_fim_proj]").after(
                        "<span class='small text-danger'>" + response.resultado['data'] + "</span>"
                    );
                    $("input[atividade=" + response.resultado['id'] + "][coluna=data_fim_proj]").addClass('is-invalid');

                });

            }

        }

    });

    $("input[coluna=data_fim_proj]").on('blur', function () {

        let date = new Date();

        if (Date.parse($(this).val()) <= date) {

            $("input[atividade=" + $(this).attr('atividade') + "][coluna=percentual_real]").val(100);

            $("input[atividade=" + $(this).attr('atividade') + "][coluna=percentual_real]").addClass('is-invalid');


        } else {

            let dados = new Object();

            dados.data_inicio = $(this).parents(".form-group.row").find("input[coluna=data_inicio_proj]").val();

            dados.data_fim = $(this).parents(".form-group.row").find("input[coluna=data_fim_proj]").val();

            dados.recurso_id = $(this).parents(".form-group.row").find("input[coluna=recurso_real_id]").val();

            dados.atividade_id = $(this).attr('atividade');

            dados.roadmap_id = null;

            let r = ajaxRequest(dados, '/ajax/calcularpercentual');

            $.when(r).done(function (response) {

                $("input[atividade=" + response.resultado['id'] + "][coluna=percentual_real]").val(response.resultado['percentual']);

                $("input[atividade=" + response.resultado['id'] + "][coluna=percentual_real]").addClass('is-invalid');

            });

        }

        $(this).addClass('is-invalid');

    })

});
