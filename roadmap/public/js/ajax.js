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
            console.log(response);
            criarLookupModal(modelo, response.success);
            if (response) {
                $('.success').text(response.success);
            }
        },
    });
});
