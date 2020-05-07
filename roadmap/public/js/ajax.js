$(".lookup").click(function (event) {
    event.preventDefault();

    let modelo = $(".lookup").attr('modelo');
    let id = $("input[name=" + modelo.toLowerCase() + '_id]').val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/ajax.js",
        type: "POST",
        data: {
            class: modelo,
            id: id,
            _token: _token
        },
        success: function (response) {

            criarLookupModal(modelo, response.success);

            if (response) {

                console.log(response);

            }
        },
    });
});


function ajaxRequest(modelo, id) {

    let _token = $('meta[name="csrf-token"]').attr('content');
    var objDiferido = $.Deferred();

    $.ajax({
        url: "/ajax.js",
        type: "POST",
        data: {
            class: modelo,
            id: id,
            _token: _token
        },
        success: function (response) {

            objDiferido.resolve(response);

        },
    });

    return objDiferido.promise()

}
