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
                        <a class="nav-link" id="pills-competencias-tab" data-toggle="pill" href="#pills-competencias"
                           role="tab" aria-controls="pills-competencias" aria-selected="false">Competências</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-equipes-tab" data-toggle="pill" href="#pills-equipes"
                           role="tab" aria-controls="pills-equipes" aria-selected="false">Equipes</a>
                    </li>
                </ul>
                {{-- Conteúdo da navegação --}}
                <div class="tab-content" id="pills-tabContent">
                    {{-- Aba Principal --}}
                    <div class="tab-pane fade show active" id="pills-principal" role="tabpanel"
                         aria-labelledby="pills-principal-tab">
                        <div class="card">
                            <div class="card-header">{{ __('Cadastrar recurso') }}</div>
                            <div class="card-body">
                                <form method="POST" id="form-principal"
                                      action="{{ route('recursos.store') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="id"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Id') }}</label>
                                        <div class="col-md-6">

                                            <input id="id" type="number"
                                                   class="form-control" name="id"
                                                   value="{{ isset($recurso->id)?$recurso->id:old('id') }}"
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nome"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
                                        <div class="col-md-6">

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
                                               class="col-md-4 col-form-label text-md-right">{{ __('Data de início') }}</label>

                                        <div class="col-md-6">
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
                                    </div>

                                    <div class="form-group row">
                                        <label for="data_fim"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Data fim') }}</label>

                                        <div class="col-md-6">
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
                         aria-labelledby="pills-principal-tab">
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
                                               class="col-md-4 col-form-label text-md-right">{{ __('Competência') }}</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input id="competencia_id" type="text"
                                                       class="form-control" name="competencia_id"
                                                       tipo="competencia_recurso"
                                                       coluna="competencia_id" autofocus>
                                                <div class="input-group-append">
                                                    <button class="input-group-text lookup"
                                                            tipo="competencias">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                    <div id="modal-Competencia">
                                                        @include('layouts.modal')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button class="btn btn-primary incluir-filho"
                                                    tipo="competencia_recurso">
                                                {{ __('Incluir') }}
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
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Aba Equipes --}}
                    <div class="tab-pane fade" id="pills-equipes" role="tabpanel"
                         aria-labelledby="pills-principal-tab">
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
                                                    <button class="input-group-text lookup"
                                                            tipo="equipes">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                    <div id="modal-Equipe">
                                                        @include('layouts.modal')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button class="btn btn-primary incluir-filho"
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
