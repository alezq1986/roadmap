$(document).ready(function ($) {

    var alteracao = 0;

    var stepper_roadmap = new Stepper(document.querySelector('#roadmap-stepper'));

    $(".next").on('click', function (event) {
        stepper_roadmap.next();

    });

    $(".previous").on('click', function (event) {
        stepper_roadmap.previous();
    });

    $('#multiselect-projetos').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control mb-2" placeholder="Pesquisa" />',
            right: '<input type="text" name="q" class="form-control mb-2" placeholder="Pesquisa" />',
        },
        fireSearch: function (value) {
            return value.length > 3;
        },
        sort: {
            left: function (a, b) {
                ;
                if (a.getAttribute("prioridade") === "" && b.getAttribute("prioridade") === "") {

                    return parseInt(a.value) > parseInt(b.value) ? 1 : -1;
                } else {
                    return parseInt(a.getAttribute("prioridade")) > parseInt(b.getAttribute("prioridade")) ? 1 : -1;
                }
            },
            right: function (a, b) {
                if (a.getAttribute("prioridade") == "" && b.getAttribute("prioridade") == "") {
                    return parseInt(a.value) > parseInt(b.value) ? 1 : -1;
                } else {
                    return parseInt(a.getAttribute("prioridade")) > parseInt(b.getAttribute("prioridade")) ? 1 : -1;
                }
            }
        }
    });

    $("#button-next-1").on('click', function () {

        var selecionados = $("#multiselect-projetos_to").children("option");

        $("#projetos-prioriza").empty();

        for (var i = 0; i < selecionados.length; i++) {

            let id = selecionados.eq(i).val();

            let copia = $("#projetos-prioriza-hidden").children(".projeto-card[projeto-id=" + id + "]").clone();

            let prioridade = selecionados.eq(i).index() + 1;

            copia.attr("projeto-prioridade", prioridade);

            copia.find("div.prioridade").eq(1).text(prioridade);

            $("#projetos-prioriza").append(copia);

        }

    });

    $("#button-next-2").on('click', function () {

        var selecionados = $("#multiselect-projetos_to").children("option");

        for (var i = 0; i < selecionados.length; i++) {

            let id = selecionados.eq(i).val();

            $("div.atividade[projeto=" + id + "]").removeClass('d-none');

        }

    });

    $("#button-previous-2").on('click', function () {

        $("div.atividade").each(function () {

            if ($(this).hasClass('d-none')) {


            } else {

                $(this).addClass('d-none')
            }

        });

    });

    $("#form-atividades input").on('blur', function () {

        alteracao = 1;

    });


    $("#projetos-prioriza").sortable({
        stop: function (event, ui) {

            alteracao = 1;

            var projetos = $("#projetos-prioriza").children();

            for (var i = 0; i < projetos.length; i++) {

                let prioridade = projetos.eq(i).index() + 1;

                projetos.eq(i).attr('projeto-prioridade', prioridade);

                projetos.eq(i).find("div.prioridade").eq(1).text(prioridade);
            }
        }
    });

    $(".alteracao").on('click', function (event) {

        alteracao = 1;

    });

    $("#button-next-3").on('click', function (event) {

        switch (parseInt($("#roadmap-cabecalho").attr("roadmap-alocado"))) {

            case 0:

                $("#alert-alocacao").hide();

                $("#alert-emprocesso").hide();

                $("#alert-pronto").hide();

                break;

            case 1:

                $("#alert-alocacao").hide();

                $("#alert-alteracao").hide();

                $("#alert-pronto").hide();

                break;

            case 2:

                if (alteracao) {

                    $("#alert-emprocesso").hide();

                    $("#alert-alocacao").hide();

                    $("#alert-pronto").hide();

                } else {

                    $("#alert-emprocesso").hide();

                    $("#alert-alteracao").hide();

                    $("#alert-alocacao").hide();

                }

                break;
        }

    });

    $("#button-previous-3").on('click', function () {

        $("#alert-emprocesso").show();

        $("#alert-alteracao").show();

        $("#alert-alocacao").show();

        $("#alert-pronto").show();

    });

    $("#configura-salvar").on('click', function () {

        let dados = new Object();

        $(this).attr("disabled", true);

        dados.roadmap = $("#roadmap-cabecalho").attr("roadmap-id");

        let projetos = Array();

        let projetos_priorizados = $("#projetos-prioriza").children();

        for (var i = 0; i < projetos_priorizados.length; i++) {

            let projeto = new Object();

            projeto.projeto_id = projetos_priorizados.eq(i).attr('projeto-id');

            projeto.roadmap_id = dados.roadmap;

            projeto.prioridade = projetos_priorizados.eq(i).attr('projeto-prioridade');

            projetos.push(projeto);
        }

        dados.projetos = projetos;

        let r1 = ajaxRequest(dados, '/projetos/incluir-roadmap');

        let a = new Object();

        let parametros = new Object();

        let atividades = new Object();

        parametros.limpar_recursos = ($("input#limpar_recursos:checked").length) ? 1 : 0;

        parametros.roadmap_id = $("#roadmap-cabecalho").attr("roadmap-id");

        $("input[atividade]").each(function () {

            if ($(this).attr('atividade') in atividades) {

                atividades[$(this).attr('atividade')][$(this).attr('coluna')] = $(this).val();

            } else {

                let o = new Object();

                o[$(this).attr('coluna')] = $(this).val();

                atividades[$(this).attr('atividade')] = o;

            }

        });

        a.parametros = parametros;

        a.atividades = atividades;

        let r2 = ajaxRequest(JSON.stringify(a), '/atividades/atualizar-massa');


        $.when(r1, r2).done(function () {

            alteracao = 0;

            if (r1.then() && r2.then()) {

                $("#alert-alteracao").hide();

                $("#alert-alocacao").fadeIn();

            }

        });

    });

    $("#configura-alocar").on('click', function (event) {

        let dados = new Object();

        dados.roadmap = $('#roadmap-cabecalho').attr('roadmap-id');

        var data = ajaxRequest(dados, '/roadmaps/alocar');

        $.when(data).done(function () {

            $("#alert-alocacao").hide();

            $("#alert-emprocesso").show();

        });

    });

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

                let r = ajaxRequest(dados, '/atividades/calcular-datas');

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

            let r = ajaxRequest(dados, '/atividades/calcular-percentual');

            $.when(r).done(function (response) {

                $("input[atividade=" + response.resultado['id'] + "][coluna=percentual_real]").val(response.resultado['percentual']);

                $("input[atividade=" + response.resultado['id'] + "][coluna=percentual_real]").addClass('is-invalid');

            });

        }

        $(this).addClass('is-invalid');

    })

    $("input[coluna=recurso_real_id]").on('blur', function () {

        $(this).addClass('is-invalid');

    });

});
