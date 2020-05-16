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
                        <form method="GET" action="{{ route('roadmaps.index') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="id" class="col-md-3 col-form-label text-md-right">{{ __('Id') }}</label>
                                <div class="col-md-3">
                                    <input id="id" type="number" class="form-control" name="id"
                                           value="{{ isset($_GET['id'])?$_GET['id']:'' }}" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data_base_de"
                                       class="col-md-3 col-form-label text-md-right">{{ __('Data base (de)') }}</label>
                                <div class="col-md-3">
                                    <input id="data_base_de" type="date" class="form-control" name="data_base_de"
                                           value="{{ isset($_GET['data_base_de'])?$_GET['data_base_de']:'' }}"
                                           autofocus>
                                </div>
                                <label for="data_base_ate"
                                       class="col-md-3 col-form-label text-md-right">{{ __('Data base (até)') }}</label>
                                <div class="col-md-3">
                                    <input id="data_base_ate" type="date" class="form-control" name="data_base_ate"
                                           value="{{ isset($_GET['data_base_ate'])?$_GET['data_base_ate']:'' }}"
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
                    <div class="card-header">{{ __('Roadmap') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-6">
                                <a class="btn btn-success float-right" href="{{ route('roadmaps.create') }}">
                                    <i class="fa fa-plus-square fa-sm"></i>
                                    {{ __('Novo') }}
                                </a>
                            </div>
                        </div>
                        <table class="table table-striped mt-2" id="laravel">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Data Base</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roadmaps as $roadmap)
                                <tr>
                                    <td>{{ $roadmap->id }}</td>
                                    <td>{{ $roadmap->data_base }}</td>
                                    <td>
                                        <a class="btn btn-primary action-buttons"
                                           href="{{ route('roadmaps.edit', $roadmap) }}">
                                            <i class="fa fa-edit fa-sm"></i>
                                        </a>
                                        <form class="d-inline" method="POST"
                                              action="{{ route('roadmaps.destroy', $roadmap) }}"
                                              onsubmit="return confirm('Tem certeza que deseja remover o Roadmap de {{$roadmap->data_base}} ?')">
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
                        {{ $roadmaps->appends($data)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@endauth
