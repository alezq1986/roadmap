$(document).ready(function ($) {

    $("#reload-button").on('click', function () {

        $(this).attr("disabled", true);

        $("canvas").fadeOut(300);

        $('#chart1').after(
            "<div class='cv-spinner'>" +
            "<span class='spinner'></span>\n" +
            "</div>"
        ).fadeIn(300);

        let dados = new Object();

        dados.tipo_dado = $("select#tipo").val();

        dados.roadmap_id = $("select#roadmap").val();

        dados.percentual = ($("input#percentual:checked").length) ? 1 : 0;

        dados.normalizado = ($("input#normalizado:checked").length) ? 1 : 0;

        let r = ajaxRequest(dados, '/relatorios/pegar-dados');

        $.when(r).done(function (response) {

            $('.cv-spinner').fadeOut(300);

            $("canvas").fadeIn(300);

            $("#reload-button").attr("disabled", false);

            let resultado = response.resultado;

            let labels = new Array();

            let data = new Array();

            let p = '';

            let d = 0;

            if (dados.percentual && dados.normalizado == 0) {

                p = '%';

            }

            if (dados.normalizado) {

                d = 2;

            }

            for (let i = 0; i < resultado.length; i++) {

                labels[i] = 'de ' + resultado[i]['inicial'].toFixed(d).toLocaleString('pt-BR') + p + ' até ' + resultado[i]['final'].toFixed(d).toLocaleString('pt-BR') + p;

                data[i] = resultado[i]['frequencia'];

            }

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Atraso normalizado',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });


        });


    });


});
