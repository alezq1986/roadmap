@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@auth

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Filtros') }}</div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('recursos.index') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="id" class="col-md-1 col-form-label text-md-right">{{ __('Id') }}</label>
                                <div class="col-md-3">
                                    <input id="id" type="number" class="form-control" name="id"
                                           value="{{ isset($_GET['id'])?$_GET['id']:'' }}" autofocus>
                                </div>
                                <label for="nome" class="col-md-2 col-form-label text-md-right">{{ __('Nome') }}</label>
                                <div class="col-md-6">
                                    <input id="nome" type="text" class="form-control" name="nome"
                                           value="{{ isset($_GET['nome'])?$_GET['nome']:'' }}" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data_inicio_de"
                                       class="col-md-3 col-form-label text-md-right">{{ __('Data início (de)') }}</label>
                                <div class="col-md-3">
                                    <input id="data_inicio_de" type="date" class="form-control" name="data_inicio_de"
                                           value="{{ isset($_GET['data_inicio_de'])?$_GET['data_inicio_de']:'' }}"
                                           autofocus>
                                </div>
                                <label for="data_inicio_ate"
                                       class="col-md-3 col-form-label text-md-right">{{ __('Data início (até)') }}</label>
                                <div class="col-md-3">
                                    <input id="data_inicio_ate" type="date" class="form-control" name="data_inicio_ate"
                                           value="{{ isset($_GET['data_inicio_ate'])?$_GET['data_inicio_ate']:'' }}"
                                           autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data_fim_de"
                                       class="col-md-3 col-form-label text-md-right">{{ __('Data fim (de)') }}</label>
                                <div class="col-md-3">
                                    <input id="data_fim_de" type="date" class="form-control" name="data_fim_de"
                                           value="{{ isset($_GET['data_fim_de'])?$_GET['data_fim_de']:'' }}" autofocus>
                                </div>
                                <label for="data_fim_ate"
                                       class="col-md-3 col-form-label text-md-right">{{ __('Data fim (até)') }}</label>
                                <div class="col-md-3">
                                    <input id="data_fim_ate" type="date" class="form-control" name="data_fim_ate"
                                           value="{{ isset($_GET['data_fim_ate'])?$_GET['data_fim_ate']:'' }}"
                                           autofocus>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-6">
                                    <button type="submit" class="btn btn-primary float-right">
                                        {{ __('Pesquisar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Recurso') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-6">
                                <a class="btn btn-success float-right" href="{{ route('recursos.create') }}">
                                    <i class="fa fa-plus-square fa-sm"></i>
                                    {{ __('Novo') }}
                                </a>
                            </div>
                        </div>
                        <table class="table table-striped mt-2" id="laravel">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Data Início</th>
                                <th>Data Fim</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recursos as $recurso)
                                <tr>
                                    <td>{{ $recurso->id }}</td>
                                    <td>{{ $recurso->nome }}</td>
                                    <td>{{ $recurso->data_inicio }}</td>
                                    <td>{{ $recurso->data_fim }}</td>
                                    <td>
                                        <a class="btn btn-primary action-buttons"
                                           href="{{ route('recursos.edit', $recurso->id) }}">
                                            <i class="fa fa-edit fa-sm"></i>
                                        </a>
                                        <a type="button" class="btn btn-danger action-buttons">
                                            <i class="fa fa-trash fa-sm"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $recursos->appends($data)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@endauth
