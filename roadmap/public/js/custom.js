function criarLookupModal(modelo, data) {

    $("#results-list").remove();

    $(".modal-body").append("<ul id='results-list'> </ul>");

    var i;
    for (i = 0; i < data.length; i++) {

        $("#results-list").append("<li id=" + data[i].id + ">" + data[i].descricao + "</li>");

    }

    $('#lookupModal').modal('show');

    $("li").click(function () {
        modelo = modelo.toLowerCase();

        $('#' + modelo + '_id').val($(this).attr('id'));
        $('#lookupModal').modal('hide');

    });

}

function inserirTabelaFilha(modelo, data) {

    modelo = modelo.toLowerCase();
    $("table#" + modelo + "tbody>").append(
        "<tr class='new-row'></tr>" +
        "<td>" + data[i].id + "</td>" +
        "<td>" + data[i].descricao + "</td>" +
        "<td> <a type='button' class='btn btn-danger action-buttons'><i class='fa fa-trash fa-sm'></i></a></td>"
    );
}
