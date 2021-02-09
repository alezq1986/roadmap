class Grafico {

    constructor(tipo) {

        this.tipo = tipo;
    }

    criarGrafico(target_id) {

        $("#" + target_id + "-chart").fadeOut(300);

        $("#" + target_id).append(
            "<div class='cv-spinner'>" +
            "<span class='spinner'></span>\n" +
            "</div>"
        ).fadeIn(300);

        let dados = new Object();

        let r;

        switch (this.tipo) {

            case 'histograma_atraso':

                dados.tipo_dado = $("#" + target_id).find("select#tipo").val();

                dados.roadmap_id = $("#" + target_id).find("select#roadmap").val();

                dados.percentual = ($("#" + target_id).find("input#percentual:checked").length) ? 1 : 0;

                dados.normalizado = ($("#" + target_id).find("input#normalizado:checked").length) ? 1 : 0;

                r = ajaxRequest(dados, '/relatorios/histograma-atraso');

                $.when(r).done(function (response) {

                    $("#" + target_id).find('.cv-spinner').fadeOut(300);

                    $("#" + target_id + "-chart").children().remove();

                    $("#" + target_id + "-chart").fadeIn(300);

                    let resultado = response.resultado;

                    if (resultado.length) {

                        let labels = new Array();

                        let data = new Array();

                        let colors = new Array();

                        let title = "Atraso (dias)";

                        let p = '';

                        let d = 0;

                        if (dados.percentual && dados.normalizado == 0) {

                            p = '%';

                            title = "Atraso (percentual)";

                        }

                        if (dados.normalizado) {

                            d = 2;

                            title += " normalizado";

                        }

                        let r = 255;

                        let g = 240;

                        let b = 160;

                        for (let i = 0; i < resultado.length; i++) {

                            labels[i] = 'de ' + resultado[i]['inicial'].toFixed(d).toLocaleString('pt-BR') + p + ' até ' + resultado[i]['final'].toFixed(d).toLocaleString('pt-BR') + p;

                            data[i] = resultado[i]['frequencia'];

                            colors[i] = "rgba(" + r + ", " + g + "," + b + ", 0.8)";

                            r = (r * 1).toFixed(0);

                            g = (g * 0.9).toFixed(0);

                            b = (b * 0.9).toFixed(0);

                        }

                        $("#" + target_id + "-chart").append(
                            "<canvas></canvas>"
                        )

                        let ctx = document.getElementById(target_id + '-chart').getElementsByTagName('canvas')[0].getContext('2d');

                        let myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: title,
                                    data: data,
                                    backgroundColor: colors,
                                    borderColor: [],
                                    borderWidth: 0
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

                    } else {

                        $("#" + target_id + "-chart").append(
                            "<span>Não há resultados.</span>"
                        );

                    }

                });


                break;

            case 'tabela_atraso':

                dados.tipo_dado = $("#" + target_id).find("select#tipo").val();

                dados.roadmap_id = $("#" + target_id).find("select#roadmap").val();

                dados.percentual = ($("#" + target_id).find("input#percentual:checked").length) ? 1 : 0;

                r = ajaxRequest(dados, '/relatorios/tabela-atraso');

                $.when(r).done(function (response) {

                    $("#" + target_id).find('.cv-spinner').fadeOut(300);

                    $("#" + target_id + "-chart").fadeIn(300);

                    let resultado = response.resultado;

                    if (resultado.length) {

                        let tabela =
                            "<table class='table table-striped mt-2'>"
                            + "<thead>"
                            + "<tr>"
                            + "<th>Projeto</th>"
                            + "<th>Equipe</th>"
                            + "<th>Atraso (dias)</th>"
                            + "<th>Atraso (%)</th>"
                            + "</tr>"
                            + "</thead>"
                            + "<tbody>";

                        for (let i = 0; i < resultado.length; i++) {

                            tabela +=
                                "<tr>"
                                + "<td>" + resultado[i]['projeto'] + "</td>"
                                + "<td>" + resultado[i]['equipe'] + "</td>"
                                + "<td>" + resultado[i]['atraso'] + "</td>"
                                + "<td>" + resultado[i]['atraso_perc'].toFixed(0).toLocaleString('pt-BR') + "</td>"
                                + "</tr>"
                        }

                        tabela +=
                            "</tbody>"
                            + "</table>";

                        $("#" + target_id + "-chart").append(tabela);

                    } else {

                        $("#" + target_id + "-chart").append(
                            "<span>Não há resultados.</span>"
                        );

                    }

                });


                break;

            default:

        }

    }


}


$(document).ready(function ($) {

    $("#reload-button[chart=chart1]").on('click', function () {

        let chart = new Grafico('histograma_atraso');

        chart.criarGrafico($(this).attr("chart"));

    });

    $("#reload-button[chart=chart2]").on('click', function () {

        $("#chart2-chart").children().remove();

        let chart = new Grafico('tabela_atraso');

        chart.criarGrafico($(this).attr("chart"));

    });


});
