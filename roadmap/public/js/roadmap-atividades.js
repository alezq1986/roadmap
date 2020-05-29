$(document).ready(function () {

    $("input[coluna=percentual_real]").on('blur', function () {

        if ($(this).val() > 0 && Date.parse($("input#" + $(this).attr('id').split("-")[0] + "-alocacoes-data_inicio_proj").val()) > new Date()) {

            alert('Uma atividade com início em data futura não pode ter percentual maior que 0. Ajuste a data de início.');

            $(this).val(0);

        } else {


            if ($(this).val() == 100) {

                let date = new Date();

                date = date.toLocaleDateString();

                $("input#" + $(this).attr('id').split("-")[0] + "-alocacoes-data_fim_proj").siblings("span").remove();

                $("input#" + $(this).attr('id').split("-")[0] + "-alocacoes-data_fim_proj").after(
                    "<span class='small text-danger'>" + date + "</span>"
                );

            } else {

                let dados = new Object();

                dados.percentual = $(this).val();

                dados.data_inicio = $(this).parents(".form-group.row").find("input[coluna=data_inicio_proj]").val();

                dados.recurso_id = $(this).parents(".form-group.row").find("input[coluna=recurso_real_id]").val();

                dados.atividade_id = $(this).attr('id').split("-")[0];

                let r = ajaxRequest(dados, 'calculardatas');

                $.when(r).done(function (response) {

                    $("input#" + response.resultado['id'] + "-alocacoes-data_fim_proj").siblings("span").remove();

                    $("input#" + response.resultado['id'] + "-alocacoes-data_fim_proj").after(
                        "<span class='small text-danger'>" + response.resultado['data'] + "</span>"
                    );

                });

            }

        }

    });

    $("input[coluna=data_fim_proj]").on('blur', function () {

        let date = new Date();

        if (Date.parse($(this).val()) <= date) {

            $("input#" + $(this).attr('id').split("-")[0] + "-atividades-percentual_real").val(100);

            $("input#" + $(this).attr('id').split("-")[0] + "-atividades-percentual_real").addClass('is-invalid');


        } else {

            let dados = new Object();

            dados.data_inicio = $(this).parents(".form-group.row").find("input[coluna=data_inicio_proj]").val();

            dados.data_fim = $(this).parents(".form-group.row").find("input[coluna=data_fim_proj]").val();

            dados.recurso_id = $(this).parents(".form-group.row").find("input[coluna=recurso_real_id]").val();

            dados.atividade_id = $(this).attr('id').split("-")[0];

            let r = ajaxRequest(dados, 'calcularpercentual');

            $.when(r).done(function (response) {

                $("input#" + response.resultado['id'] + "-atividades-percentual_real").val(response.resultado['percentual']);

                $("input#" + response.resultado['id'] + "-atividades-percentual_real").addClass('is-invalid');

            });

        }

    })

});
