@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection
@auth

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                            <div class="card-header">{{ __('Cadastrar projeto') }}</div>
                            <div class="card-body">
                                <form method="POST" id="form-principal" action="{{ route('projetos.store') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="descricao"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                                        <div class="col-md-6">
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
                                    </div>
                                    <div class="form-group row">
                                        <label for="equipe_id"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Equipe') }}</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input id="equipe_id" type="text"
                                                       class="form-control" name="equipe_id"
                                                       autofocus>
                                                <div class="input-group-append">
                                                    <button class="input-group-text lookup"
                                                            modelo="Equipe">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                    @include('layouts.modal')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                                        <div class="col-md-6">
                                            <select id="status"
                                                    class="form-control" name="status"
                                                    value="{{ isset($projeto->status)?$projeto->status:old('status') }}"
                                                    disabled>
                                                <option value="0"
                                                        @if(isset($projeto->status) && $projeto->status == 0) selected @endif>
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
                                    </div>
                                    <div class="form-group row">
                                        <label for="status_aprovacao"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Status aprovação') }}</label>
                                        <div class="col-md-6">
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
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Aba Atividades --}}
                    <div class="tab-pane fade" id="pills-atividades" role="tabpanel"
                         aria-labelledby="pills-atividades-tab">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endauth
