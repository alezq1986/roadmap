$(".include-child").on('click', function (event) {

    event.preventDefault();

    let modelo = $(this).attr('modelo');

    let id = $("input[name=" + modelo.toLowerCase() + '_id]').val();

    inserirTabelaFilha(modelo, id);

});

$(".lookup").on('click', function (event) {
    event.preventDefault();

    let modelo = $(".lookup").attr('modelo');


    let id = $("input[name=" + modelo.toLowerCase() + '_id]').val();

    let dados = new Array();

    let dado = new Object();

    dado.modelo = modelo;

    dado.id = id;

    dados.push(dado);

    var data = ajaxRequest(dados, 'consultar');


    $.when(data).done(function (response) {

        criarLookupModal(modelo, response.success);
    });

});

$("#form-principal").on('submit', function (event) {

    passarFilhosSessao();

});

$("table").on('click', '.remover-filho', function () {

    if ($(this).closest('td').hasClass('new-row')) {

        $(this).closest('tr').remove();

    } else {
        let modelo = $(this).closest('table').attr('modelo');

        let id = $(this).closest('tr').attr('id');

        removerTabelaFilha(modelo, id);
    }


});


function ajaxRequest(dados, acao) {

    let _token = $('meta[name="csrf-token"]').attr('content');
    var objDiferido = $.Deferred();

    $.ajax({
        url: "/ajax",
        type: "POST",
        dataType: 'JSON',
        data: {
            dados: dados,
            acao: acao,
            _token: _token
        },
        success: function (response) {

            objDiferido.resolve(response);

        },
    });

    return objDiferido.promise()

}

function criarLookupModal(modelo, data) {

    $("#results-list").remove();

    $(".modal-body").append("<ul id='results-list'> </ul>");

    var i;
    for (i = 0; i < data.length; i++) {

        $("#results-list").append("<li id=" + data[i].id + ">" + data[i].descricao + "</li>");

    }

    $('#lookupModal').modal('show');

    $("li").click(function () {

        let id_escolhida = $(this).attr('id');

        $('#' + modelo.toLowerCase() + '_id').val(id_escolhida);

        $('#lookupModal').modal('hide');

    });

}

function inserirTabelaFilha(modelo, id) {

    if ($("table[modelo=" + modelo + "]").find("tr#" + id).length > 0) {
        alert('Esse registro já existe na tabela.');
    } else {

        let dados = new Array();

        let dado = new Object();

        dado.modelo = modelo;

        dado.id = id;

        dados.push(dado);

        var data = ajaxRequest(dados, 'consultar');

        ajaxRequest(null, 'aguardar');

        $.when(data).done(function (response) {

            var objeto = response.success[0];

            var tabela = null;

            var entries = Object.entries(objeto);

            for (var i = 0; i < entries.length; i++) {

                let entry = entries[i];

                if (entry[0] == 'id' || entry[0] == 'nome' || entry[0] == 'descricao') {

                    tabela = tabela + "<td class='new-row' coluna=" + entry[0] + " coluna-valor=" + entry[1] + ">" + entry[1] + "</td>";
                }

            }

            $("table[modelo=" + modelo + "]>tbody").append(
                "<tr id=" + objeto.id + ">" +
                tabela +
                "<td class='new-row'> <a type='button' class='btn btn-danger action-buttons remover-filho'><i class='fa fa-trash fa-sm'></i></a></td></tr>"
            );

        });

    }

}

function removerTabelaFilha(modelo, id) {

    $("table[modelo=" + modelo + "]").find("tr#" + id).children().addClass('deleted-row');

    var data = ajaxRequest(null, 'aguardar');
}

function passarFilhosSessao() {

    let filhos = new Object();

    let filhos_incluir = new Array();

    let filhos_deletar = new Array();

    $(".new-row[coluna='id']").each(function () {

        let c = new Object();

        c.modelo = $(this).parents("table").attr('modelo');

        c.id = parseInt($(this).text());

        filhos_incluir.push(c);

        filhos.filhos_incluir = filhos_incluir;

    });

    $(".deleted-row[coluna='id']").each(function () {

        let d = new Object();

        d.modelo = $(this).parents("table").attr('modelo');

        d.id = parseInt($(this).text());

        filhos_deletar.push(d);

        filhos.filhos_deletar = filhos_deletar;

    });

    var data = ajaxRequest(filhos, 'editar');

}






