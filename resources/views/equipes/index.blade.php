@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent


@endsection
@auth

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Filtros') }}</div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('equipes.index') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="id" class="col-md-1 col-form-label text-md-right">{{ __('Id') }}</label>
                                <div class="col-md-3">
                                    <input id="id" type="number" class="form-control" name="id"
                                           value="{{ isset($_GET['id'])?$_GET['id']:'' }}" autofocus>
                                </div>
                                <label for="descricao"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Descricao') }}</label>
                                <div class="col-md-6">
                                    <input id="descricao" type="text" class="form-control" name="descricao"
                                           value="{{ isset($_GET['descricao'])?$_GET['descricao']:'' }}" autofocus>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('equipe') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-6">
                                <a class="btn btn-success float-right" href="{{ route('equipes.create') }}">
                                    <i class="fa fa-plus-square fa-sm"></i>
                                    {{ __('Novo') }}
                                </a>
                            </div>
                        </div>
                        <table class="table table-striped mt-2" id="laravel">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Descrição</th>
                                <th class="text-right">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($equipes as $equipe)
                                <tr>
                                    <td>{{ $equipe->id }}</td>
                                    <td>{{ $equipe->descricao }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-primary action-buttons"
                                           href="{{ route('equipes.edit', $equipe->id) }}">
                                            <i class="fa fa-edit fa-sm"></i>
                                        </a>
                                        <form class="d-inline" method="POST"
                                              action="{{ route('equipes.destroy', $equipe) }}"
                                              onsubmit="return confirm('Tem certeza que deseja remover {{$equipe->descricao}} ?')">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger action-buttons">
                                                <i class="fa fa-edit fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $equipes->appends($data)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@endauth
