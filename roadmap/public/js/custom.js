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

$(".include-child").click(function (event) {

    event.preventDefault();

    let modelo = $(".lookup").attr('modelo');
    let id = $("input[name=" + modelo.toLowerCase() + '_id]').val();

    inserirTabelaFilha(modelo, id);

});

function inserirTabelaFilha(modelo, id) {

    var data = ajaxRequest(modelo, id);

    $.when(data).done(function (response) {

        $("table#" + modelo + ">tbody").append(
            "<tr></tr>" +
            "<td class='new-row'>TBD</td>" +
            "<td class='new-row'>" + response.success[0].descricao + "</td>" +
            "<td class='new-row'> <a type='button' class='btn btn-danger action-buttons'><i class='fa fa-trash fa-sm'></i></a></td>"
        );
    });

}


