@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection
@auth

@section('content')
    <div class="alert alert-secondary" role="alert" id="roadmap-cabecalho" roadmap-id="{{$roadmap->id}}"
         roadmap-alocado="{{$roadmap->alocado}}">
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
                            <div class="alert alert-primary" role="alert" id="alert-alocacao">
                                <h4 class="alert-heading">Pronto!</h4>
                                <p>O Roadmap está pronto para ser alocado. Ao clicar no botão abaixo, a requisição será
                                    incluída em uma fila e você será notificado quando estiver pronta.</p>
                                <hr>
                                <button class="btn btn-secondary" id="configura-alocar">Alocar</button>
                            </div>
                            <div class="alert alert-danger" role="alert" id="alert-emprocesso">
                                <h4 class="alert-heading">Em processo!</h4>
                                <p>Há um processo de alocação deste Roadmap em curso. Aguarde o término.</p>
                                <hr>
                            </div>
                            <div class="alert alert-success" role="alert" id="alert-pronto">
                                <h4 class="alert-heading">Alocado!</h4>
                                <p>Este Roadmap já está alocado e não foram identificadas modificações.</p>
                                <hr>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts-especificos')
    <script type="text/javascript" src="{{ asset('js/multiselect.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/roadmap-configura.js') }}"></script>

@stop

@endauth


