google.charts.load('current', {'packages': ['gantt']});

google.charts.setOnLoadCallback(drawChart);

function daysToMilliseconds(days) {
    return days * 24 * 60 * 60 * 1000;
}

function drawChart() {

    let projeto_id = $("input#id").val();

    let roadmap_id = $("input#roadmap").val();

    let dados = new Object();

    dados.roadmap_id = roadmap_id;

    dados.projeto_id = projeto_id;

    let req = ajaxRequest(dados, '/roadmaps/gantt-dados');

    $.when(req).done(function (response) {

        let resultado = response.resultado;

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'ID Atividade');
        data.addColumn('string', 'Atividade');
        data.addColumn('date', 'Data Início');
        data.addColumn('date', 'Data Fim');
        data.addColumn('number', 'Prazo');
        data.addColumn('number', 'Percentual');
        data.addColumn('string', 'Dependências');

        let arr = new Array();

        for (let i = 0; i < resultado['atividades'].length; i++) {

            let d = resultado['dependencias'].filter(function (a) {

                return (a.atividade == resultado['atividades'][i]['atividade_id']);
            });


            let deps = new Array();

            for (let j = 0; j < d.length; j++) {

                deps.push(d[j]['dependencia']);

            }

            let a = [String(resultado['atividades'][i]['atividade_id']), resultado['atividades'][i]['projeto'] + "-" + resultado['atividades'][i]['descricao'],
                new Date(resultado['atividades'][i]['data_inicio']), new Date(resultado['atividades'][i]['data_fim']),
                daysToMilliseconds(resultado['atividades'][i]['prazo']), parseInt(resultado['atividades'][i]['percentual_real']), deps.length ? deps.join() : null];

            arr.push(a);

        }

        data.addRows(arr);

        var options = {
            height: arr.length * 40 + 60,
            width: 3000,
            gantt: {
                criticalPathEnabled: false,
                arrow: {
                    angle: 100,
                    width: 1,
                    color: 'dodgerblue',
                    radius: 0
                },
                labelStyle: {
                    fontName: 'Nunito',
                    fontSize: 12,
                    color: 'dodgerblue'
                },
                barCornerRadius: 2,
                backgroundColor: {
                    fill: 'transparent',
                },
                innerGridHorizLine: {
                    stroke: '#ddd',
                    strokeWidth: 0,
                },
                innerGridTrack: {
                    fill: 'transparent'
                },
                innerGridDarkTrack: {
                    fill: 'transparent'
                },
                percentEnabled: true,
                // percentStyle: {
                //   fill:    'black',
                // },
                shadowEnabled: false
            }
        };

        var chart = new google.visualization.Gantt(document.getElementById('gantt'));

        chart.draw(data, options);


    });


}




