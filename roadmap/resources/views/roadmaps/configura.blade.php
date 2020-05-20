@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@auth

@section('content')
    <div class="alert alert-secondary" role="alert" id="roadmap-cabecalho" roadmap-id="{{$roadmap->id}}">
        Roadmap: {{$roadmap->descricao}} | data base: {{date('d-m-Y', strtotime($roadmap->data_base))}}
    </div>
    <div class="bs-stepper linear" id="roadmap-stepper">
        <div class="bs-stepper-header" role="tablist">
            <!-- Cabeçalho Stepper -->
            <div class="step active" data-target="#selecao-projetos">
                <button type="button" class="step-trigger" role="tab" aria-controls="selecao-projetos"
                        id="selecao-projetos-trigger">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label">Seleção</span>
                </button>
            </div>
            <div class="bs-stepper-line"></div>
            <div class="step" data-target="#priorizacao-projetos">
                <button type="button" class="step-trigger" role="tab" aria-controls="priorizacao-projetos"
                        id="priorizacao-projetos-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">Priorização</span>
                </button>
            </div>
            <div class="bs-stepper-line"></div>
            <div class="step" data-target="#alocacao-projetos">
                <button type="button" class="step-trigger" role="tab" aria-controls="alocacao-projetos"
                        id="alocacao-projetos-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">Alocação</span>
                </button>
            </div>
        </div>
        <!-- Conteúdo Stepper -->
        <div class="bs-stepper-content">
            <!-- Seleção -->
            <div id="selecao-projetos" class="bs-stepper-pane active dstepper-block" role="tabpanel"
                 aria-labelledby="selecao-projetos-trigger">

                <div class="row pb-2 sticky-top">
                    <div class="col-md-12">
                        <button id="button-next-1" class="btn btn-primary next">Próximo</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="alert alert-danger" role="alert">
                            Não alocados
                        </div>
                        <select name="from[]" id="multiselect-projetos" class="form-control" size="8"
                                multiple="multiple">
                            @foreach($projetos as $projeto)
                                @if($projeto->roadmap_id != $roadmap->id)
                                    <option value="{{$projeto->id}}"
                                            prioridade="{{$projeto->prioridade}}"> {{$projeto->projeto_descricao}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 botoes-mover">
                        <button type="button" id="multiselect-projetos_rightAll" class="btn btn-block alteracao"><i
                                class="fa fa-forward"></i></button>
                        <button type="button" id="multiselect-projetos_rightSelected"
                                class="btn btn-block alteracao"><i
                                class="fa fa-chevron-right"></i></button>
                        <button type="button" id="multiselect-projetos_leftSelected"
                                class="btn btn-block alteracao"><i
                                class="fa fa-chevron-left"></i></button>
                        <button type="button" id="multiselect-projetos_leftAll" class="btn btn-block alteracao"><i
                                class="fa fa-backward"></i></button>
                    </div>
                    <div class="col-md-5">
                        <div class="alert alert-success" role="alert">
                            Alocados
                        </div>
                        <select name="to[]" id="multiselect-projetos_to" class="form-control" size="8"
                                multiple="multiple">
                            @foreach($projetos as $projeto)
                                @if($projeto->roadmap_id == $roadmap->id)
                                    <option value="{{$projeto->id}}"
                                            prioridade="{{$projeto->prioridade}}"> {{$projeto->projeto_descricao}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Priorização -->
            <div id="priorizacao-projetos" class="bs-stepper-pane" role="tabpanel"
                 aria-labelledby="priorizacao-projetos-trigger">

                <div class="row pb-2 sticky-top">
                    <div class="col-md-12">
                        <button class="btn btn-primary previous">Anterior</button>
                        <button class="btn  btn-primary next" id="button-next-2">Próximo</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div id="projetos-prioriza">

                        </div>
                        <div id="projetos-prioriza-hidden" class="d-none">
                            @foreach($projetos as $projeto)
                                <div class="projeto-card" projeto-id="{{$projeto->id}}"
                                     projeto-prioridade="{{$projeto->prioridade}}">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div
                                                        class="badge badge-light prioridade">{{$projeto->prioridade}}</div>
                                                    <div class="badge badge-dark prioridade"></div>
                                                </div>
                                                <div class="col-md-3">{{$projeto->projeto_descricao}}</div>
                                                <div
                                                    class="col-md-3">{{$projeto->equipe_descricao}}</div>
                                                <div class="col-md-2">
                                                    @switch($projeto->status)
                                                        @case(0)
                                                        <span class='badge badge-secondary'>Não iniciado</span>
                                                        @break
                                                        @case(1)
                                                        <span class='badge badge-warning'>Em desenvolvimento</span>
                                                        @break
                                                        @case(2)
                                                        <span class='badge badge-primary'>Em teste</span>
                                                        @break
                                                        @case(3)
                                                        <span class='badge badge-success'>Finalizado</span>
                                                        @break
                                                    @endswitch
                                                </div>
                                                <div class="col-md-2">
                                                    @switch($projeto->status_aprovacao)
                                                        @case(0)
                                                        <span class='badge badge-secondary'>Não aprovado</span>
                                                        @break
                                                        @case(1)
                                                        <span class='badge badge-warning'>Previsto</span>
                                                        @break
                                                        @case(2)
                                                        <span class='badge badge-success'>Aprovado</span>
                                                        @break
                                                        @case(3)
                                                        <span class='badge badge-danger'>Suspenso</span>
                                                        @break
                                                    @endswitch
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
            </div>
            <!-- Alocação -->
            <div id="alocacao-projetos" class="bs-stepper-pane" role="tabpanel"
                 aria-labelledby="alocacao-projetos-trigger">
                <div class="row pb-2 sticky-top">
                    <div class="col-md-12">
                        <button class="btn btn-primary previous" id="button-previous-3">Anterior</button>
                    </div>
                </div>
                <div class="row" id="alocacao-projetos-conteudo">

                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert" id="alert-alteracao">
                            <h4 class="alert-heading">Atenção!</h4>
                            <p>Foram identificadas modificações na seleção e/ou priorização de projetos em relação
                                ao Roadmap
                                anterior. Para prosseguir com a alocação, as modificações deverão ser salvas
                                antes.</p>
                            <hr>
                            <button class="btn btn-secondary" id="configura-salvar">Salvar</button>
                        </div>
                        <div class="alert alert-success" role="alert" id="alert-alocacao">
                            <h4 class="alert-heading">Pronto!</h4>
                            <p>O Roadmap está pronto para ser alocado. Ao clicar no botão abaixo, a requisição será
                                incluída em uma fila e você será notificado quando estiver pronta.</p>
                            <hr>
                            <button class="btn btn-secondary" id="configura-salvar">Alocar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts-especificos')
    <script type="text/javascript" src="{{ asset('js/multiselect.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function ($) {

            var alteracao = 0;

            var stepper_roadmap = new Stepper(document.querySelector('#roadmap-stepper'));

            $(".next").on('click', function (event) {
                stepper_roadmap.next();
            });

            $(".previous").on('click', function (event) {
                stepper_roadmap.previous();
            });

            $('#multiselect-projetos').multiselect({
                search: {
                    left: '<input type="text" name="q" class="form-control mb-2" placeholder="Pesquisa" />',
                    right: '<input type="text" name="q" class="form-control mb-2" placeholder="Pesquisa" />',
                },
                fireSearch: function (value) {
                    return value.length > 3;
                },
                sort: {
                    left: function (a, b) {
                        ;
                        if (a.getAttribute("prioridade") === "" && b.getAttribute("prioridade") === "") {

                            return parseInt(a.value) > parseInt(b.value) ? 1 : -1;
                        } else {
                            return parseInt(a.getAttribute("prioridade")) > parseInt(b.getAttribute("prioridade")) ? 1 : -1;
                        }
                    },
                    right: function (a, b) {
                        if (a.getAttribute("prioridade") == "" && b.getAttribute("prioridade") == "") {
                            return parseInt(a.value) > parseInt(b.value) ? 1 : -1;
                        } else {
                            return parseInt(a.getAttribute("prioridade")) > parseInt(b.getAttribute("prioridade")) ? 1 : -1;
                        }
                    }
                }
            });

            $("#button-next-1").on('click', function (event) {

                var selecionados = $("#multiselect-projetos_to").children("option");

                $("#projetos-prioriza").empty();

                for (var i = 0; i < selecionados.length; i++) {

                    let id = selecionados.eq(i).val();

                    let copia = $("#projetos-prioriza-hidden").children(".projeto-card[projeto-id=" + id + "]").clone();

                    let prioridade = selecionados.eq(i).index() + 1;

                    copia.attr("projeto-prioridade", prioridade);

                    copia.find("div.prioridade").eq(1).text(prioridade);

                    $("#projetos-prioriza").append(copia);

                }

            });


            $("#projetos-prioriza").sortable({
                stop: function (event, ui) {

                    alteracao = 1;

                    var projetos = $("#projetos-prioriza").children();

                    for (var i = 0; i < projetos.length; i++) {

                        let prioridade = projetos.eq(i).index() + 1;

                        projetos.eq(i).attr('projeto-prioridade', prioridade);

                        projetos.eq(i).find("div.prioridade").eq(1).text(prioridade);
                    }
                }
            });

            $(".alteracao").on('click', function (event) {

                alteracao = 1;

            });

            $("#button-next-2").on('click', function (event) {

                if (alteracao) {

                    $("#alert-alocacao").hide();

                } else {

                    $("#alert-alteracao").hide();
                }
            });

            $("#button-previous-3").on('click', function (event) {

                $("#alert-alocacao").show();


                $("#alert-alteracao").show();

            });

            $("#configura-salvar").on('click', function (event) {

                let dados = new Object();

                dados.roadmap = $("#roadmap-cabecalho").attr("roadmap-id");

                let projetos = Array();

                let projetos_priorizados = $("#projetos-prioriza").children();

                for (var i = 0; i < projetos_priorizados.length; i++) {

                    let projeto = new Object();

                    projeto.projeto_id = projetos_priorizados.eq(i).attr('projeto-id');

                    projeto.roadmap_id = dados.roadmap;

                    projeto.prioridade = projetos_priorizados.eq(i).attr('projeto-prioridade');

                    projetos.push(projeto);
                }

                dados.projetos = projetos;

                var data = ajaxRequest(dados, 'atualizar-projetos');

                $.when(data).done(function () {

                    alteracao = 0;

                    if (data.then()) {

                        $("#alert-alteracao").hide();

                        $("#alert-alocacao").fadeIn();

                    }

                });

            });
        });

    </script>

@stop

@endauth


