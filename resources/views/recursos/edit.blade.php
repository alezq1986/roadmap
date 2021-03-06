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
                        <form class="d-inline" method="POST"
                              action="{{ route('recursos.destroy', $recurso) }}"
                              onsubmit="return confirm('Tem certeza que deseja remover {{$recurso->nome}} ?')">
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
                        <a class="nav-link" id="pills-competencias-tab" data-toggle="pill" href="#pills-competencias"
                           role="tab" aria-controls="pills-competencias" aria-selected="false">Competências</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-equipes-tab" data-toggle="pill" href="#pills-equipes"
                           role="tab" aria-controls="pills-equipes" aria-selected="false">Equipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-bloqueios-tab" data-toggle="pill" href="#pills-bloqueios"
                           role="tab" aria-controls="pills-bloqueios" aria-selected="false">Bloqueios</a>
                    </li>
                </ul>
                {{-- Conteúdo da navegação --}}
                <div class="tab-content" id="pills-tabContent">
                    {{-- Aba Principal --}}
                    <div class="tab-pane fade show active" id="pills-principal" role="tabpanel"
                         aria-labelledby="pills-principal-tab">
                        <div class="card">
                            <div class="card-header">{{ __('Editar recurso') }}</div>
                            <div class="card-body">
                                <form method="POST" id="form-principal"
                                      action="{{ route('recursos.update', $recurso) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group row">
                                        <label for="id"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Id') }}</label>
                                        <div class="col-md-4">

                                            <input id="id" type="number"
                                                   class="form-control" name="id"
                                                   value="{{ isset($recurso->id)?$recurso->id:old('id') }}"
                                                   disabled>
                                        </div>
                                        <label for="nome"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Nome') }}</label>
                                        <div class="col-md-4">

                                            <input id="nome" type="text"
                                                   class="form-control @error('nome') is-invalid @enderror" name="nome"
                                                   value="{{ isset($recurso->nome)?$recurso->nome:old('nome') }}"
                                                   required
                                                   autocomplete="nome" autofocus>

                                            @error('nome')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="data_inicio"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Data de início') }}</label>

                                        <div class="col-md-4">
                                            <input id="data_inicio" type="date"
                                                   class="form-control @error('data_inicio') is-invalid @enderror"
                                                   name="data_inicio"
                                                   value="{{  isset($recurso->data_inicio)?$recurso->data_inicio:old('data_inicio')  }}"
                                                   required autocomplete="data_inicio">

                                            @error('data_inicio')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <label for="data_fim"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Data fim') }}</label>

                                        <div class="col-md-4">
                                            <input id="data_fim" type="date"
                                                   class="form-control @error('data_fim') is-invalid @enderror"
                                                   name="data_fim"
                                                   value="{{  isset($recurso->data_fim)?$recurso->data_fim:old('data_fim')  }}"
                                                   required autocomplete="data_fim">

                                            @error('data_fim')
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
                    {{-- Aba Competências --}}
                    <div class="tab-pane fade" id="pills-competencias" role="tabpanel"
                         aria-labelledby="pills-competencias-tab">
                        <div class="card mb-5">
                            <div class="card-header">{{ __('Competências') }}</div>
                            <div class="card-body">
                                <form method="POST" action="" tipo="competencia_recurso" class="form-filho">
                                    @csrf
                                    <div class="form-group row d-none">
                                        <label for="id"
                                               class="col-md-3 col-form-label text-md-right">{{ __('Id') }}</label>
                                        <div class="col-md-3">
                                            <input id="id" type="text"
                                                   class="form-control" name="id" tipo="competencia_recurso"
                                                   coluna="id" disabled>
                                        </div>
                                        <label for="recurso_id"
                                               class="col-md-3 col-form-label text-md-right">{{ __('Recurso') }}</label>
                                        <div class="col-md-3">
                                            <input id="recurso_id" type="text"
                                                   class="form-control" name="recurso_id" tipo="competencia_recurso"
                                                   coluna="recurso_id" value="{{isset($recurso->id)?$recurso->id:null}}"
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="competencia_id"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Competência') }}</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input id="competencia_id" type="text"
                                                       class="form-control" name="competencia_id"
                                                       tipo="competencia_recurso"
                                                       coluna="competencia_id" autofocus>
                                                <div class="input-group-append">
                                                    <button class="input-group-text"
                                                            modal-tipo="competencias">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                       id="permite_aloc_automatica" name="permite_aloc_automatica"
                                                       tipo="competencia_recurso"
                                                       coluna="permite_aloc_automatica">
                                                <label class="form-check-label" for="permite_aloc_automatica">
                                                    Permite alocação automática
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary float-right incluir-filho"
                                                    tipo="competencia_recurso">
                                                {{ __('Incluir') }}
                                            </button>
                                            <button class="btn btn-primary atualizar-filho d-none"
                                                    tipo="competencia_recurso">
                                                {{ __('Atualizar') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">{{ __('Competências') }}</div>
                            <div class="card-body">
                                <table class="table table-striped mt-2 tabela-filha" tipo="competencia_recurso">
                                    <thead>
                                    <tr>
                                        <th class="d-none" coluna="id">Id</th>
                                        <th coluna="recurso_id">Recurso</th>
                                        <th coluna="competencia_id">Competencia</th>
                                        <th coluna="permite_aloc_automatica">Alocação automática</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($competencias as $competencia)
                                        <tr id="{{ $competencia->id }}">
                                            <td class="d-none" coluna="id"
                                                coluna-valor="{{ $competencia->pivot->id }}"></td>
                                            <td coluna="recurso_id"
                                                coluna-valor="{{ $competencia->pivot->recurso_id }}">{{ $competencia->pivot->recurso_id }}
                                                - {{ $recurso->nome }}</td>
                                            <td coluna="competencia_id"
                                                coluna-valor="{{ $competencia->pivot->competencia_id }}">{{ $competencia->pivot->competencia_id }}
                                                - {{ $competencia->descricao }}</td>
                                            <td coluna="permite_aloc_automatica"
                                                coluna-valor="{{ $competencia->pivot->permite_aloc_automatica}}">{{ $competencia->pivot->permite_aloc_automatica }}
                                                - @if ($competencia->pivot->permite_aloc_automatica == 0) Não @else
                                                    Sim @endif</td>
                                            <td>
                                                <a type="button"
                                                   class="btn btn-danger action-buttons remover-filho">
                                                    <i class="fa fa-trash fa-sm"></i>
                                                </a>
                                                <a type="button" class="btn btn-primary action-buttons editar-filho">
                                                    <i class="fa fa-edit fa-sm"></i>
                                                </a>
                                                <a type="button" class="btn btn-primary action-buttons"
                                                   href="{{ route('competencias.edit', $competencia) }}"
                                                   target="_blank">
                                                    <i class="fa fa-eye fa-sm"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Aba Equipes --}}
                    <div class="tab-pane fade" id="pills-equipes" role="tabpanel"
                         aria-labelledby="pills-equipes-tab">
                        <div class="card mb-5">
                            <div class="card-header">{{ __('Equipes') }}</div>
                            <div class="card-body">
                                <form method="POST" action="" tipo="equipe_recurso" class="form-filho">
                                    @csrf
                                    <div class="form-group row d-none">
                                        <label for="id"
                                               class="col-md-3 col-form-label text-md-right">{{ __('Id') }}</label>
                                        <div class="col-md-3">
                                            <input id="id" type="text"
                                                   class="form-control" name="id" tipo="equipe_recurso"
                                                   coluna="id" disabled>
                                        </div>
                                        <label for="recurso_id"
                                               class="col-md-3 col-form-label text-md-right">{{ __('Recurso') }}</label>
                                        <div class="col-md-3">
                                            <input id="recurso_id" type="text"
                                                   class="form-control" name="recurso_id" tipo="equipe_recurso"
                                                   coluna="recurso_id" value="{{isset($recurso->id)?$recurso->id:null}}"
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="equipe_id"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Equipe') }}</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input id="equipe_id" type="text"
                                                       class="form-control" name="equipe_id" tipo="equipe_recurso"
                                                       coluna="equipe_id" autofocus>
                                                <div class="input-group-append">
                                                    <button class="input-group-text"
                                                            modal-tipo="equipes">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary float-right incluir-filho"
                                                    tipo="equipe_recurso">
                                                {{ __('Incluir') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">{{ __('Equipes') }}</div>
                            <div class="card-body">
                                <table class="table table-striped mt-2 tabela-filha" tipo="equipe_recurso">
                                    <thead>
                                    <tr>
                                        <th class="d-none" coluna="id">Id</th>
                                        <th coluna="recurso_id">Recurso</th>
                                        <th coluna="equipe_id">Equipe</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($equipes as $equipe)
                                        <tr id="{{ $equipe->id }}">
                                            <td class="d-none" coluna="id"
                                                coluna-valor=""></td>
                                            <td coluna="recurso_id"
                                                coluna-valor="{{ $equipe->pivot->recurso_id }}">{{ $equipe->pivot->recurso_id }}
                                                - {{ $recurso->nome }}</td>
                                            <td coluna="equipe_id"
                                                coluna-valor="{{ $equipe->pivot->equipe_id }}">{{ $equipe->pivot->equipe_id }}
                                                - {{ $equipe->descricao }}</td>
                                            <td>
                                                <a type="button"
                                                   class="btn btn-danger action-buttons remover-filho">
                                                    <i class="fa fa-trash fa-sm"></i>
                                                </a>
                                                <a type="button" class="btn btn-primary action-buttons"
                                                   href="{{ route('equipes.edit', $equipe) }}"
                                                   target="_blank">
                                                    <i class="fa fa-eye fa-sm"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Aba Bloqueios --}}
                    <div class="tab-pane fade" id="pills-bloqueios" role="tabpanel"
                         aria-labelledby="pills-bloqueios-tab">
                        <div class="card mb-5">
                            <div class="card-header">{{ __('Bloqueios') }}</div>
                            <div class="card-body">
                                <form method="POST" action="" tipo="bloqueios" class="form-filho">
                                    @csrf
                                    <div class="form-group row d-none">
                                        <label for="id"
                                               class="col-md-3 col-form-label text-md-right">{{ __('Id') }}</label>
                                        <div class="col-md-3">
                                            <input id="id" type="text"
                                                   class="form-control" name="id" tipo="bloqueios"
                                                   coluna="id" disabled>
                                        </div>
                                        <label for="recurso_id"
                                               class="col-md-3 col-form-label text-md-right">{{ __('Recurso') }}</label>
                                        <div class="col-md-3">
                                            <input id="recurso_id" type="text"
                                                   class="form-control" name="recurso_id" tipo="bloqueios"
                                                   coluna="recurso_id" value="{{isset($recurso->id)?$recurso->id:null}}"
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="data_inicio"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Data de início') }}</label>
                                        <div class="col-md-4">
                                            <input id="data_inicio" type="date"
                                                   class="form-control" name="data_inicio"
                                                   tipo="bloqueios"
                                                   coluna="data_inicio" autofocus>
                                        </div>
                                        <label for="data_fim"
                                               class="col-md-2 col-form-label text-md-right">{{ __('Data fim') }}</label>
                                        <div class="col-md-4">
                                            <input id="data_fim" type="date"
                                                   class="form-control" name="data_fim"
                                                   tipo="bloqueios"
                                                   coluna="data_fim" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary float-right incluir-filho"
                                                    tipo="bloqueios">
                                                {{ __('Incluir') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">{{ __('Bloqueios') }}</div>
                            <div class="card-body">
                                <table class="table table-striped mt-2 tabela-filha" tipo="bloqueios">
                                    <thead>
                                    <tr>
                                        <th class="d-none" coluna="id">Id</th>
                                        <th coluna="recurso_id">Recurso</th>
                                        <th coluna="data_inicio">Data início</th>
                                        <th coluna="data_fim">Data fim</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bloqueios as $bloqueio)
                                        <tr id="{{ $bloqueio->id }}">
                                            <td class="d-none" coluna="id"
                                                coluna-valor="{{ $bloqueio->id }}"></td>
                                            <td coluna="recurso_id"
                                                coluna-valor="{{ $bloqueio->recurso_id }}">{{ $bloqueio->recurso_id }}
                                                - {{ $recurso->nome }}</td>
                                            <td coluna="data_inicio"
                                                coluna-valor="{{ $bloqueio->data_inicio }}">{{$bloqueio->data_inicio }}</td>
                                            <td coluna="data_fim"
                                                coluna-valor="{{ $bloqueio->data_fim }}">{{$bloqueio->data_fim }}</td>
                                            <td>
                                                <a type="button"
                                                   class="btn btn-danger action-buttons remover-filho">
                                                    <i class="fa fa-trash fa-sm"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
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
@endauth
