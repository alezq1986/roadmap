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
                <div class="card">
                    <div class="card-header">{{ __('Filtros') }}
                        <a class="btn btn-primary float-right text-white" id="reload-button">
                            <i class="fa fa-arrow-alt-circle-down fa-sm"></i>
                            {{ __('Atualizar') }}
                        </a>
                    </div>
                    <div class="card-body" id="chart1">
                        <div class="form-group row">
                            <label for="roadmap"
                                   class="col-md-3 col-form-label text-md-right">{{ __('Roadmap') }}</label>
                            <div class="col-md-5">
                                <select id="roadmap" class="form-control" name="roadmap">
                                    @foreach($roadmaps as $roadmap)
                                        <option value="{{$roadmap->id}}">{{$roadmap->descricao}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="percentual" name="percentual"
                                           value="1">
                                    <label for="percentual"
                                           class="form-check-label">{{ __('Percentual') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tipo"
                                   class="col-md-3 col-form-label text-md-right">{{ __('Tipo') }}</label>
                            <div class="col-md-5">
                                <select id="tipo" class="form-control" name="tipo">
                                    <option value="0">Atividades fechadas</option>
                                    <option value="1">Atividades abertas</option>
                                    <option value="2">Projetos fechados</option>
                                    <option value="3">Projetos abertos</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="normalizado" name="normalizado"
                                           value="1">
                                    <label for="normalizado"
                                           class="form-check-label">{{ __('Normalizado') }}</label>
                                </div>
                            </div>
                        </div>
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('scripts-especificos')
            <script type="text/javascript" src="{{ asset('js/relatorios.js') }}"></script>

@endsection


@endauth
