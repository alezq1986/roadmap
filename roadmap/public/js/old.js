function ajaxRequest(dados, rota) {

    let _token = $('meta[name="csrf-token"]').attr('content');
    var objDiferido = $.Deferred();

    $.ajax({
        url: "/ajax/" + rota,
        type: "POST",
        dataType: 'JSON',
        data: {
            dados: dados,
            _token: _token
        },
        success: function (response) {

            objDiferido.resolve(response);

        },
    });

    return objDiferido.promise()

}

function criarLookupModal(tipo, data, target) {

    let modal = $("#" + target);

    switch (tipo) {

        case 'competencias':

            var coluna = 'descricao';

            break;

        case 'equipes':

            var coluna = 'descricao';

            break

        case 'recurso-competencia':

            var coluna = 'nome';

            break;

        default:
    }

    modal.find("#results-list").remove();

    modal.find(".modal-body").append("<ul id='results-list'> </ul>");

    let i;
    for (i = 0; i < data.length; i++) {

        modal.find("#results-list").append("<li id=" + data[i].id + ">" + data[i][coluna] + "</li>");

    }

    modal.children("div").modal('show');

    $("li").click(function () {

        let id_escolhida = $(this).attr('id');

        $(this).parents(".input-group").children("input").val(id_escolhida);

        $('.modal').modal('hide');

    });

}

// function inserirTabelaFilha(tipo) {
//
//     let objeto = new Object();
//
//     let inputs = $("form[tipo=" + tipo + "]").find('input');
//
//     let selects = $("form[tipo=" + tipo + "]").find('select');
//
//     inputs.each(function () {
//
//         objeto[$(this).attr("coluna")] = $(this).val();
//
//     });
//
//     selects.each(function () {
//
//         objeto[$(this).attr("coluna")] = $(this).val();
//
//     });
//     let headers = $("table[tipo=" + tipo + "]").find("th");
//
//     let colunas = new Array();
//
//     let classes = new Array();
//
//     headers.each(function () {
//
//         colunas.push($(this).attr('coluna'));
//
//         if (typeof $(this).attr('class') !== 'undefined') {
//
//             classes.push($(this).attr('class'));
//
//         } else {
//
//             classes.push("");
//         }
//
//
//     });
//
//     let celulas = null;
//
//     let entries = Object.entries(objeto);
//
//     let j = 0;
//
//     for (let i = 0; i < entries.length; i++) {
//
//         let entry = entries[i];
//
//         if (jQuery.inArray(entry[0], colunas) > -1) {
//
//             celulas = celulas + "<td class='new-row " + classes[j] + "' coluna=" + entry[0] + " coluna-valor=" + entry[1] + ">" + entry[1] + "</td>";
//
//             j++;
//         }
//
//     }
//
//     $("table[tipo=" + tipo + "]>tbody").append(
//         "<tr id=>" +
//
//         celulas +
//
//         "<td class='new-row'> <a type='button' class='btn btn-danger action-buttons remover-filho'><i class='fa fa-trash fa-sm'></i></a></td></tr>"
//     );
//
// }

// function removerTabelaFilha(tipo, id) {
//
//     $("table[tipo=" + tipo + "]").find("tr#" + id).children().addClass('deleted-row');
//
// }

// function passarFilhosSessao(tipo) {
//
//     let dados = new Object();
//
//     let filhos_incluir = new Array();
//
//     let filhos_deletar = new Array();
//
//     $("table[tipo=" + tipo + "]").find(".new-row").parents("tr").each(function () {
//
//         let o = new Object();
//
//         $(this).children().each(function () {
//
//             o[$(this).attr('coluna')] = $(this).attr('coluna-valor');
//
//
//         })
//
//         filhos_incluir.push(o);
//
//     });
//
//     dados.filhos_incluir = filhos_incluir;
//
//
//     $("table[tipo=" + tipo + "]").find(".deleted-row").parents("tr").each(function () {
//
//         let o = new Object();
//
//         $(this).children().each(function () {
//
//             o[$(this).attr('coluna')] = $(this).attr('coluna-valor');
//
//
//         })
//
//         filhos_deletar.push(o);
//
//     });
//
//     dados.filhos_deletar = filhos_deletar;
//
//     dados.tipo = tipo;
//
//     ajaxRequest(dados, 'incluir');
//
// }

////////////////////////////////////////////////
$(document).ready(function () {
    // $("button[form=form-principal]").on('click', function (event) {
    //
    //     event.preventDefault();
    //
    //     let requests = new Array();
    //
    //     $(".form-filho").each(function () {
    //
    //         let tipo = $(this).attr('tipo');
    //
    //         request = passarFilhosSessao(tipo);
    //
    //         requests.push($request);
    //
    //     });
    //
    //     $.when($requests).done(function (response) {
    //
    //         $("form#form-principal").submit();
    //
    //     });
    //
    // });

    // $(".incluir-filho").on('click', function (event) {
    //
    //     event.preventDefault();
    //
    //     let tipo = $(this).attr('tipo');
    //
    //     let pos = tipo.indexOf('_');
    //
    //     if (pos != -1) {
    //
    //         let chave = tipo.substring(pos + 1) + "_id";
    //
    //         let valor = $("input[tipo=" + tipo + "][coluna=" + chave + "]").val();
    //
    //         if ($("table[tipo=" + tipo + "]").find("td[coluna=" + chave + "][coluna-valor=" + valor + "]").length > 0) {
    //
    //             alert('Esse registro já existe na tabela');
    //
    //         } else {
    //
    //             inserirTabelaFilha(tipo);
    //         }
    //
    //     } else {
    //
    //         inserirTabelaFilha(tipo);
    //     }
    //
    //
    // });

    // $(".lookup").on('click', function (event) {
    //
    //     event.preventDefault();
    //
    //     let target = $(this).siblings("div").attr('id');
    //
    //     let dados = new Object();
    //
    //     let tipo = $(this).attr('tipo');
    //
    //     if ($(this).parent().siblings('input').length) {
    //
    //         var valor = $(this).parent().siblings('input').val();
    //
    //     } else if ($(this).parent().siblings('select').length) {
    //
    //         var valor = $(this).parent().siblings('select').val();
    //
    //     } else {
    //
    //         return;
    //
    //     }
    //
    //     switch (tipo) {
    //
    //         case 'recurso-competencia':
    //
    //             var valor_relacionado = $(".lookup[tipo=competencias]").parent().siblings('input').val()
    //
    //             dados.valor_relacionado = valor_relacionado;
    //
    //             break;
    //
    //         default:
    //     }
    //
    //     dados.tipo = tipo;
    //
    //     dados.valor = valor;
    //
    //     var data = ajaxRequest(dados, 'consultar');
    //
    //     $.when(data).done(function (response) {
    //
    //         criarLookupModal(tipo, response.resultado, target);
    //     });
    //
    // });

    // $("table").on('click', '.remover-filho', function () {
    //
    //     let tipo = $(this).closest('table').attr('tipo');
    //
    //     if ($(this).closest('td').hasClass('new-row')) {
    //
    //         $(this).closest('tr').remove();
    //
    //     } else {
    //
    //         let id = $(this).closest('tr').attr('id');
    //
    //         removerTabelaFilha(tipo, id);
    //     }
    //
    // });

});


