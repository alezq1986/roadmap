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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card mb-5">
                    <div class="card-header">{{ __('Filtros') }}</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="id" class="col-md-1 col-form-label text-md-right">{{ __('Id') }}</label>
                            <div class="col-md-3">
                                <input type="number" class="form-control" name="id" autofocus>
                            </div>
                            <label for="descricao"
                                   class="col-md-2 col-form-label text-md-right">{{ __('Descrição') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="descricao" autofocus>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-6">
                                <button class="btn btn-primary float-right" id="pesquisar-roadmap">
                                    {{ __('Pesquisar') }}
                                </button>
                                <button class="btn btn-success float-right mr-2" id="exportar-roadmap">
                                    {{ __('Exportar') }}
                                </button>
                                <a class="btn btn-warning float-right mr-2" id="gantt-roadmap"
                                   href="{{ route('roadmaps.gantt', $roadmap)}}">
                                    {{ __('Gantt') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                @foreach($atividades as $k => $atividade)
                    @if($k == 0|| $atividades[$k-1]->projeto_id != $atividade->projeto_id)
                        <div class="projeto-card" projeto-id="{{$atividade->projeto_id}}"
                             projeto-descricao="{{$atividade->projeto}}">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <a class="btn btn-secondary action-buttons"
                                               href="{{ route('projetos.show', $atividade->projeto_id) }}">
                                                <i class="fa fa-eye fa-sm"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-1">
                                            <div
                                                class="badge badge-light prioridade">{{$atividade->prioridade}}</div>
                                        </div>
                                        <div class="col-md-3">({{$atividade->projeto_id}}) {{$atividade->projeto}}</div>

                                        <div
                                            class="col-md-3">{{$atividade->equipe}}</div>
                                        <div class="col-md-2">
                                            @switch($atividade->status)
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
                                            @switch($atividade->status_aprovacao)
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
                                    <div class="row bg-info font-weight-bold">
                                        <div class="col-2">
                                            Competência
                                        </div>
                                        <div class="col-2">
                                            Prazo (dias)
                                        </div>
                                        <div class="col-2">
                                            Data início
                                        </div>
                                        <div class="col-2">
                                            Data fim
                                        </div>
                                        <div class="col-2">
                                            Recurso
                                        </div>
                                        <div class="col-2">
                                            Percentual
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row border-bottom">
                                        <div class="col-2">
                                            {{$atividade->descricao}}
                                        </div>
                                        <div class="col-2">
                                            {{$atividade->prazo}}
                                        </div>
                                        <div class="col-2">
                                            {{$atividade->data_inicio_proj}}
                                        </div>
                                        <div class="col-2">
                                            {{$atividade->data_fim_proj}}
                                        </div>
                                        <div class="col-2">
                                            {{$atividade->recurso}}
                                        </div>
                                        <div class="col-2">
                                            {{$atividade->percentual_real}}
                                        </div>
                                    </div>
                                    @if($k == $atividades->count()-1 || $atividades[$k+1]->projeto_id != $atividade->projeto_id)
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts-especificos')
    <script type="text/javascript" src="{{ asset('js/roadmap-visualiza.js') }}"></script>

@endsection


@endauth
