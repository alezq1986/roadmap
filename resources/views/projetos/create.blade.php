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
                            {{ __('Cadastrar') }}
                        </button>
                    </div>
                </div>
                {{-- Navegação --}}
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-principal-tab" data-toggle="pill" href="#pills-principal"
                           role="tab" aria-controls="pills-principal" aria-selected="true">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-atividades-tab" data-toggle="pill" href="#pills-atividades"
                           role="tab" aria-controls="pills-atividades" aria-selected="false">Atividades</a>
                    </li>
                </ul>
                {{-- Conteúdo da navegação --}}
                <div class="tab-content" id="pills-tabContent">
                    {{-- Aba Principal --}}
                    <div class="tab-pane fade show active" id="pills-principal" role="tabpanel"
                         aria-labelledby="pills-principal-tab">
                        <div class="card">
                            <div class="card-header">{{ __('Editar projeto') }}</div>
                            <div class="card-body">
                                <form method="POST" id="form-principal"
                                      action="{{ route('projetos.store') }}">
                                    @csrf
                                    <div class="form-group row d-none">
                                        <label for="id"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Id') }}</label>
                                        <div class="col-md-6">
                                            <input id="id" type="number"
                                                   class="form-control" name="id"
                                                   value="{{ isset($projeto->id)?$projeto->id:old('id') }}"
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="descricao"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Descrição') }}</label>

                                        <div class="col-md-4">
                                            <input id="descricao" type="text"
                                                   class="form-control @error('descricao') is-invalid @enderror"
                                                   name="descricao"
                                                   value="{{ isset($projeto->descricao)?$projeto->descricao:old('descricao') }}"
                                                   required
                                                   autocomplete="descricao" autofocus>

                                            @error('descricao')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        <label for="equipe_id"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Equipe') }}</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input id="equipe_id" type="text"
                                                       class="form-control" name="equipe_id"
                                                       value="{{ isset($projeto->equipe_id)?$projeto->equipe_id:old('equipe_id') }}"
                                                       autofocus>
                                                <div class="input-group-append">
                                                    <button class="input-group-text"
                                                            modal-tipo="equipes">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Status') }}</label>
                                        <div class="col-md-4">
                                            <select id="status"
                                                    class="form-control" name="status"
                                                    value="{{ isset($projeto->status)?$projeto->status:old('status') }}"
                                                    disabled>
                                                <option value="0"
                                                        @if((isset($projeto->status) && $projeto->status == 0) || !isset($projeto->status) ) selected @endif>
                                                    Não iniciado
                                                </option>
                                                <option value="1"
                                                        @if(isset($projeto->status) && $projeto->status == 1) selected @endif>
                                                    Em desenvolvimento
                                                </option>
                                                <option value="2"
                                                        @if(isset($projeto->status) && $projeto->status == 2) selected @endif>
                                                    Em teste
                                                </option>
                                                <option value="3"
                                                        @if(isset($projeto->status) && $projeto->status == 3) selected @endif>
                                                    Finalizado
                                                </option>
                                            </select>
                                        </div>
                                        <label for="status_aprovacao"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Status aprovação') }}</label>
                                        <div class="col-md-4">
                                            <select id="status_aprovacao"
                                                    class="form-control" name="status_aprovacao"
                                                    value="{{ isset($projeto->status_aprovacao)?$projeto->status_aprovacao:old('status_aprovacao') }}">
                                                <option value="0"
                                                        @if(isset($projeto->status_aprovacao) && $projeto->status_aprovacao == 0) selected @endif>
                                                    Não aprovado
                                                </option>
                                                <option value="1"
                                                        @if(isset($projeto->status_aprovacao) && $projeto->status_aprovacao == 1) selected @endif>
                                                    Previsto
                                                </option>
                                                <option value="2"
                                                        @if(isset($projeto->status_aprovacao) && $projeto->status_aprovacao == 2) selected @endif>
                                                    Aprovado
                                                </option>
                                                <option value="3"
                                                        @if(isset($projeto->status_aprovacao) && $projeto->status_aprovacao == 3) selected @endif>
                                                    Suspenso
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="data_entrega"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Data entrega') }}</label>

                                        <div class="col-md-4">
                                            <input id="data_entrega" type="date"
                                                   class="form-control @error('data_entrega') is-invalid @enderror"
                                                   name="data_entrega"
                                                   value="{{ isset($projeto->data_entrega)?$projeto->data_entrega:old('data_entrega') }}"
                                                   required
                                                   autocomplete="data_entrega" autofocus>

                                            @error('data_entrega')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Aba Atividades --}}
                    <div class="tab-pane fade" id="pills-atividades" role="tabpanel"
                         aria-labelledby="pills-atividades-tab">

                        <div class="card mb-5">
                            <div class="card-header">{{ __('Atividades') }}</div>
                            <div class="card-body">
                                <form class="form-filho" method="POST" action="" tipo="atividades">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="atividades.id"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Id') }}</label>
                                        <div class="col-md-2">
                                            <input id="atividades.id" type="number"
                                                   class="form-control" name="atividades.id"
                                                   coluna="id"
                                                   disabled>
                                        </div>
                                        <label for="atividades.projeto_id"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Projeto') }}</label>
                                        <div class="col-md-2">
                                            <input id="atividades.projeto_id" type="number"
                                                   class="form-control" name="atividades.projeto_id"
                                                   value="{{isset($projeto->id)?$projeto->id:null}}"
                                                   coluna="projeto_id"
                                                   disabled>
                                        </div>
                                        <label for="atividade_codigo"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Código interno') }}</label>
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <input id="atividades.atividade_codigo" type="number" min="1"
                                                       class="form-control" name="atividades.atividade_codigo"
                                                       coluna="atividade_codigo"
                                                       autofocus>
                                                <div class="input-group-append">
                                                    <button class="input-group-text"
                                                            sequencial-tipo="atividade_codigo">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="atividades.descricao"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Descrição') }}</label>
                                        <div class="col-md-10">
                                            <input id="atividades.descricao" type="text"
                                                   class="form-control" name="atividades.descricao"
                                                   coluna="descricao"
                                                   autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="atividades.competencia_id"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Competência') }}</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input id="atividades.competencia_id" type="text"
                                                       class="form-control" name="atividades.competencia_id"
                                                       autofocus
                                                       coluna="competencia_id">
                                                <div class="input-group-append">
                                                    <button class="input-group-text"
                                                            modal-tipo="competencias">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <label for="atividades.prazo"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Prazo') }}</label>
                                        <div class="col-md-4">
                                            <input id="atividades.prazo" type="text"
                                                   class="form-control" name="atividades.prazo"
                                                   coluna="prazo"
                                                   autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="atividades.data_inicio_real"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Data início') }}</label>
                                        <div class="col-md-4">
                                            <input id="atividades.data_inicio_real" type="date"
                                                   class="form-control" name="atividades.data_inicio_real"
                                                   coluna="data_inicio_real"
                                                   autofocus>
                                        </div>
                                        <label for="atividades.data_fim_real"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Data fim') }}</label>
                                        <div class="col-md-4">
                                            <input id="atividades.data_fim_real" type="date"
                                                   class="form-control" name="atividades.data_fim_real"
                                                   coluna="data_fim_real"
                                                   autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="atividades.recurso_real_id"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Recurso') }}</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input id="atividades.recurso_real_id" type="text"
                                                       class="form-control" name="atividades.recurso_real_id"
                                                       coluna="recurso_real_id"
                                                       autofocus>
                                                <div class="input-group-append">
                                                    <button class="input-group-text"
                                                            modal-tipo="recursos_competencias">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <label for="atividades.percentual_real"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Percentual') }}</label>
                                        <div class="col-md-4">
                                            <input id="atividades.percentual_real" type="text"
                                                   class="form-control" name="atividades.percentual_real"
                                                   coluna="percentual_real"
                                                   value="0"
                                                   autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button class="btn btn-primary incluir-filho"
                                                    tipo="atividades">
                                                {{ __('Incluir') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">{{ __('Atividades') }}</div>
                            <div class="card-body">
                                <table class="table table-striped mt-2 tabela-filha" tipo="atividades">
                                    <thead>
                                    <tr>
                                        <th coluna="id" class="d-none">Id</th>
                                        <th coluna="projeto_id" class="d-none">Projeto</th>
                                        <th coluna="atividade_codigo">Código interno</th>
                                        <th coluna="descricao">Descrição</th>
                                        <th coluna="competencia_id">Competência</th>
                                        <th coluna="prazo">Prazo</th>
                                        <th coluna="data_inicio_real" class="d-none">Data início</th>
                                        <th coluna="data_fim_real" class="d-none">Data fim</th>
                                        <th coluna="recurso_real_id">Recurso</th>
                                        <th coluna="percentual_real" class="d-none">Percentual</th>
                                        <th coluna="">Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts-especificos')
    <script type="text/javascript">

        $(document).ready(function () {

            let m = 0;

            $("button[modal-tipo=competencias]").on('click', function () {

                m = 1;

            });

            $(".input-group-append").on('click', 'li', function () {

                if ($(this).parents("div[tipo=competencias]").length == 1) {

                    let d = $(this).text();

                    $("input[coluna=descricao]").val(d);

                    m = 0;
                }

            });

        });

    </script>

@endsection


@endauth
