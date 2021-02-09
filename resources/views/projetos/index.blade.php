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
                        <form method="GET" action="{{ route('projetos.index') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="id" class="col-md-1 col-form-label text-md-right">{{ __('Id') }}</label>
                                <div class="col-md-3">
                                    <input id="id" type="number" class="form-control" name="id"
                                           value="{{ isset($_GET['id'])?$_GET['id']:'' }}" autofocus>
                                </div>
                                <label for="descricao"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Descrição') }}</label>
                                <div class="col-md-6">
                                    <input id="descricao" type="text" class="form-control" name="descricao"
                                           value="{{ isset($_GET['descricao'])?$_GET['descricao']:'' }}" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id"
                                       class="col-md-1 col-form-label text-md-right">{{ __('Status aprov.') }}</label>
                                <div class="col-md-3">
                                    <select id="status_aprovacao" class="form-control" name="status_aprovacao"
                                            value="{{ isset($_GET['status_aprovacao'])?$_GET['status_aprovacao']:'' }}"
                                            autofocus>
                                        <option value="0"
                                                @if(isset($_GET['status_aprovacao']) && $_GET['status_aprovacao'] == 0) selected @endif>
                                            Não aprovado
                                        </option>
                                        <option value="1"
                                                @if(isset($_GET['status_aprovacao']) && $_GET['status_aprovacao'] == 1) selected @endif>
                                            Previsto
                                        </option>
                                        <option value="2"
                                                @if(isset($_GET['status_aprovacao']) && $_GET['status_aprovacao'] == 2) selected @endif>
                                            Aprovado
                                        </option>
                                        <option value="3"
                                                @if(isset($_GET['status_aprovacao']) && $_GET['status_aprovacao'] == 3) selected @endif>
                                            Suspenso
                                        </option>
                                        <option value=""
                                                @if(!isset($_GET['status_aprovacao']) || $_GET['status_aprovacao'] == '') selected @endif>
                                            Todos
                                        </option>
                                    </select>
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
                    <div class="card-header">{{ __('Projeto') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-6">
                                <a class="btn btn-success float-right" href="{{ route('projetos.create') }}">
                                    <i class="fa fa-plus-square fa-sm"></i>
                                    {{ __('Novo') }}
                                </a>
                                <a class="btn btn-warning float-right mr-2" data-toggle="modal"
                                   data-target="#modal_reprovar">
                                    <i class="fa fa-ban fa-sm"></i>
                                    {{ __('Reprovar') }}
                                </a>

                                <div class="modal fade" id="modal_reprovar" tabindex="-1" role="dialog"
                                     aria-hidden="true">
                                    <form id="form_reprovar" method="GET" action="{{ route('projetos.reprovar') }}">
                                        @csrf
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Reprovar projetos
                                                        previstos</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label for="data_criacao"
                                                               class="col-md-2 col-form-label text-md-right">{{ __('Data de criação') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="data_criacao" type="date"
                                                                   class="form-control"
                                                                   name="data_criacao"
                                                                   value="{{ date('Y-m-d') }}"
                                                                   required
                                                                   autocomplete="data_criacao" autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Fechar
                                                    </button>
                                                    <button class="btn btn-primary" type="submit">
                                                        Confirmar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <table class="table table-striped mt-2" id="laravel">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Descrição</th>
                                <th>Status de aprovação</th>
                                <th>Status</th>
                                <th>Data de criação</th>
                                <th class="text-right">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projetos as $projeto)
                                <tr>
                                    <td>{{ $projeto->id }}</td>
                                    <td>{{ $projeto->descricao }}</td>
                                    <td>@switch($projeto->status_aprovacao)
                                            @case (0)
                                            Não aprovado
                                            @break

                                            @case (1)
                                            Previsto
                                            @break

                                            @case (2)
                                            Aprovado
                                            @break

                                            @default
                                            Suspenso
                                        @endswitch
                                    </td>
                                    <td>@switch($projeto->status)
                                            @case (0)
                                            Não iniciado
                                            @break

                                            @case (1)
                                            Em desenvolvimento
                                            @break

                                            @case (2)
                                            Em teste
                                            @break

                                            @default
                                            Finalizado
                                        @endswitch
                                    </td>
                                    <td>{{ $projeto->created_at->format('d-m-Y') }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-success action-buttons"
                                           href="{{ route('projetos.show', $projeto->id) }}">
                                            <i class="fa fa-eye fa-sm"></i>
                                        </a>
                                        <a class="btn btn-primary action-buttons"
                                           href="{{ route('projetos.edit', $projeto->id) }}">
                                            <i class="fa fa-edit fa-sm"></i>
                                        </a>
                                        <form class="d-inline" method="POST"
                                              action="{{ route('projetos.destroy', $projeto) }}"
                                              onsubmit="return confirm('Tem certeza que deseja remover {{$projeto->descricao}} ?')">
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
                        {{ $projetos->appends($data)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@endauth
