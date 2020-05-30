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

        //let r1 = ajaxRequest(dados, '/ajax/atualizarprojetos');

        let a = new Object();

        let parametros = new Object();

        let atividades = new Object();

        parametros.limpar_recursos = ($("input#limpar_recursos:checked") === 'undefined') ? 0 : 1;

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

        let r2 = ajaxRequest(JSON.stringify(a), '/atividades/atualizaratividades');


        $.when(r2).done(function () {

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

        var data = ajaxRequest(dados, '/ajax/alocarprojetos');

        $.when(data).done(function () {

            $("#alert-alocacao").hide();

            $("#alert-emprocesso").show();

        });

    });

});
