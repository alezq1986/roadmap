$(document).ready(function () {

    $("a#importar-projeto").on('click', function (event) {

        event.preventDefault();

        let dados = new Object();

        let rota = '/projetos/importar';

        let req = ajaxRequest(dados, rota);

        $.when(req).done(function (response) {

            if (response.resultado) {

                let projs = '';

                $.each(response.resultado, function (key, value){
                    projs = projs + value + '\n';

                });

                alert('Projetos importados\n'+ projs);

            } else {

                alert('Ocorreu um erro na importação.');

            }


        });

    });
});
