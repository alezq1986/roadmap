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
                        <form class="d-inline" method="POST"
                              action="{{ route('projetos.destroy', $projeto) }}"
                              onsubmit="return confirm('Tem certeza que deseja remover {{$projeto->descricao}} ?')">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger main-buttons">
                                {{ __('Excluir') }}
                            </button>
                        </form>
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
                    <li class="nav-item">
                        <a class="nav-link" id="pills-alocacao-tab" data-toggle="pill" href="#pills-alocacao"
                           role="tab" aria-controls="pills-alocacao" aria-selected="false">Alocação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-roadmaps-tab" data-toggle="pill" href="#pills-roadmaps"
                           role="tab" aria-controls="pills-roadmaps" aria-selected="false">Roadmaps</a>
                    </li>
                </ul>
                {{-- Conteúdo da navegação --}}
                <div class="tab-content" id="pills-tabContent">
                    {{-- Aba Principal --}}
                    <div class="tab-pane fade show active" id="pills-principal" role="tabpanel"
                         aria-labelledby="pills-principal-tab">
                        <div class="card">
                            <div class="card-header">{{ __('Projeto') }}</div>
                            <div class="card-body">
                                <form method="" id="form-principal">
                                    <div class="form-group row">
                                        <label for="id"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Id') }}</label>
                                        <div class="col-md-4">
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
                                                   class="form-control"
                                                   name="descricao"
                                                   value="{{ isset($projeto->descricao)?$projeto->descricao:old('descricao') }}"
                                                   required
                                                   autocomplete="descricao" disabled>
                                        </div>
                                        <label for="equipe_id"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Equipe') }}</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input id="equipe_id" type="text"
                                                       class="form-control" name="equipe_id"
                                                       value="{{ isset($projeto->equipe_id)?$projeto->equipe_id:old('equipe_id') }}"
                                                       disabled>
                                                <div class="input-group-append">
                                                    <button class="input-group-text"
                                                            modal-tipo="">
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
                                                        @if(is_null($projeto->status)  && $projeto->status == 0) selected @endif>
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
                                                    value="{{ isset($projeto->status_aprovacao)?$projeto->status_aprovacao:old('status_aprovacao') }}"
                                                    disabled>
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
                                                   class="form-control"
                                                   name="data_entrega"
                                                   value="{{ isset($projeto->data_entrega)?$projeto->data_entrega:old('data_entrega') }}"
                                                   required
                                                   autocomplete="data_entrega" disabled>
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
                                <form class="form-filho" method="" action="" tipo="atividades">
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
                                                       disabled>
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
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="atividades.competencia_id"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Competência') }}</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input id="atividades.competencia_id" type="text"
                                                       class="form-control" name="atividades.competencia_id"
                                                       coluna="competencia_id" disabled>
                                                <div class="input-group-append">
                                                    <button class="input-group-text"
                                                            modal-tipo="competencias" disabled>
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
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="atividades.data_inicio_real"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Data início') }}</label>
                                        <div class="col-md-4">
                                            <input id="atividades.data_inicio_real" type="date"
                                                   class="form-control" name="atividades.data_inicio_real"
                                                   coluna="data_inicio_real"
                                                   disabled>
                                        </div>
                                        <label for="atividades.data_fim_real"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Data fim') }}</label>
                                        <div class="col-md-4">
                                            <input id="atividades.data_fim_real" type="date"
                                                   class="form-control" name="atividades.data_fim_real"
                                                   coluna="data_fim_real"
                                                   disabled>
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
                                                       disabled>
                                                <div class="input-group-append">
                                                    <button class="input-group-text"
                                                            modal-tipo="recursos_competencias" disabled>
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
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($atividades as $atividade)
                                        <tr id="{{ $atividade->id }}">
                                            <td class="d-none" coluna="id"
                                                coluna-valor="{{ $atividade->id }}">{{ $atividade->id }}</td>
                                            <td class="d-none" coluna="projeto_id"
                                                coluna-valor="{{ $atividade->projeto_id }}">{{ $atividade->projeto_id }}</td>
                                            <td coluna="atividade_codigo"
                                                coluna-valor="{{ $atividade->atividade_codigo }}">{{ $atividade->atividade_codigo }}</td>
                                            <td coluna="descricao"
                                                coluna-valor="{{ $atividade->descricao }}">{{ $atividade->descricao }}</td>
                                            <td coluna="competencia_id"
                                                coluna-valor="{{ $atividade->competencia_id }}">{{ $atividade->competencia_id }}</td>
                                            <td coluna="prazo"
                                                coluna-valor="{{ $atividade->prazo }}">{{ $atividade->prazo }}</td>
                                            <td class="d-none" coluna="data_inicio_real"
                                                coluna-valor="{{ $atividade->data_inicio_real }}">{{ $atividade->data_inicio_real }}</td>
                                            <td class="d-none" coluna="data_fim_real"
                                                coluna-valor="{{ $atividade->data_fim_real }}">{{ $atividade->data_fim_real }}</td>
                                            <td coluna="recurso_real_id"
                                                coluna-valor="{{ $atividade->recurso_real_id }}">{{ $atividade->recurso_real_id }}</td>
                                            <td class="d-none" coluna="percentual_real"
                                                coluna-valor="{{ $atividade->percentual_real }}">{{ $atividade->percentual_real }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Aba Alocação --}}
                    <div class="tab-pane fade" id="pills-alocacao" role="tabpanel"
                         aria-labelledby="pills-alocacao-tab">
                        <div id="gantt"></div>
                    </div>
                    {{-- Aba Roadmaps --}}
                    <div class="tab-pane fade" id="pills-roadmaps" role="tabpanel"
                         aria-labelledby="pills-roadmaps-tab">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts-especificos')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="{{ asset('js/roadmap-gantt.js') }}"></script>
    <link href="{{ asset('css/roadmap-gantt.css') }}" rel="stylesheet">

@endsection

@endauth
