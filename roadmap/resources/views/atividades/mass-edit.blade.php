@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection
@auth

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- Botões --}}
                <div class="row mb-2 pb-2 border-bottom">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary main-buttons" form="form-principal">
                            {{ __('Atualizar') }}
                        </button>

                    </div>
                </div>
                {{-- Conteúdo da navegação --}}
                <form method="POST" id="form-principal"
                      action="{{ route('atividades.massupdate') }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="alert alert-primary" role="alert">
                                <input id="limpar_recursos" type="checkbox"
                                       class="form-check-input ml-1" name="limpar_recursos" value="1">
                                <label class="form-check-label ml-4" for="limpar_recursos">
                                    Desalocar recursos de atividades não iniciadas
                                </label>
                            </div>
                        </div>
                    </div>
                    @foreach($atividades as $atividade)
                        <div class="form-group row">
                            <div class="col-md-2">
                                <span>{{$atividade->projeto}}</span>
                            </div>
                            <div class="col-md-2">
                                <span>{{$atividade->descricao}}</span>
                            </div>
                            <div class="col-md-2">
                                <input id="{{$atividade->id}}-atividades-competencia_id" type="number"
                                       class="form-control d-none" name="{{$atividade->id}}-atividades-competencia_id"
                                       valor-atual="{{$atividade->competencia_id}}"
                                       value="{{$atividade->competencia_id}}"
                                       coluna="competencia_id"
                                       autofocus>
                                <input id="{{$atividade->id}}-projetos-equipe_id" type="number"
                                       class="form-control d-none" name="{{$atividade->id}}-projetos-equipe_id"
                                       valor-atual="{{$atividade->equipe_id}}"
                                       value="{{$atividade->equipe_id}}"
                                       coluna="equipe_id"
                                       autofocus>
                                <input id="{{$atividade->id}}-alocacoes-data_inicio_proj" type="date"
                                       class="form-control" name="{{$atividade->id}}-alocacoes-data_inicio_proj"
                                       valor-atual="{{$atividade->data_inicio_proj}}"
                                       value="{{$atividade->data_inicio_proj}}"
                                       coluna="data_inicio_proj"
                                       autofocus
                                       @if($atividade->data_inicio_proj == $atividade->data_inicio_real) disabled @endif>
                            </div>
                            <div class="col-md-2">
                                <input id="{{$atividade->id}}-alocacoes-data_fim_proj" type="date"
                                       class="form-control" name="{{$atividade->id}}-alocacoes-data_fim_proj"
                                       valor-atual="{{$atividade->data_fim_proj}}"
                                       value="{{$atividade->data_fim_proj}}"
                                       coluna="data_fim_proj"
                                       autofocus>
                            </div>
                            <div class="col-md-2">
                                <input id="{{$atividade->id}}-atividades-percentual_real" type="number"
                                       class="form-control" name="{{$atividade->id}}-atividades-percentual_real"
                                       valor-atual="{{$atividade->percentual_real}}"
                                       value="{{$atividade->percentual_real}}"
                                       coluna="percentual_real"
                                       autofocus>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input id="{{$atividade->id}}-recursos-recurso_real_id" type="text"
                                           class="form-control" name="{{$atividade->id}}-recursos-recurso_real_id"
                                           valor-atual="{{$atividade->recurso_real_id}}"
                                           value="{{$atividade->recurso_real_id}}"
                                           coluna="recurso_real_id"
                                           autofocus>
                                    <div class="input-group-append">
                                        <button class="input-group-text"
                                                modal-tipo="recursos_competencias_equipes">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <span class="small">{{$atividade->nome}}</span>
                            </div>
                        </div>

                    @endforeach
                </form>
                {{-- Conteúdo da navegação --}}
            </div>
        </div>
    </div>
@endsection

@section('scripts-especificos')
    <script type="text/javascript" src="{{ asset('js/roadmap-atividades.js') }}"></script>

@endsection

@endauth
