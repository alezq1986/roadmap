@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@auth

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- Botões --}}
                <div class="row mb-2 pb-2 border-bottom">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary main-buttons" form="form-roadmap">
                            {{ __('Atualizar') }}
                        </button>
                        <form class="d-inline" method="POST"
                              action="{{ route('roadmaps.destroy', $roadmap) }}"
                              onsubmit="return confirm('Tem certeza que deseja remover o Roadmap de {{$roadmap->data_base}} ?')">
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
                        <a class="nav-link" id="pills-priorizacao-tab" data-toggle="pill" href="#pills-priorizacao"
                           role="tab" aria-controls="pills-priorizacao" aria-selected="false">Priorização</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-alocacao-tab" data-toggle="pill" href="#pills-alocacao"
                           role="tab" aria-controls="pills-alocacao" aria-selected="false">Alocação</a>
                    </li>
                </ul>
                {{-- Conteúdo da navegação --}}
                <div class="tab-content" id="pills-tabContent">
                    {{-- Aba Principal --}}
                    <div class="tab-pane fade show active" id="pills-principal" role="tabpanel"
                         aria-labelledby="pills-principal-tab">
                        <div class="card">
                            <div class="card-header">{{ __('Editar roadmap') }}</div>
                            <div class="card-body">
                                <form method="POST" id="form-roadmap" action="{{ route('roadmaps.update', $roadmap) }}">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-group row">
                                        <label for="id"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Id') }}</label>
                                        <div class="col-md-6">

                                            <input id="id" type="number"
                                                   class="form-control" name="id"
                                                   value="{{ isset($roadmap->id)?$roadmap->id:old('id') }}"
                                                   disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="data_base"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Data base') }}</label>

                                        <div class="col-md-6">
                                            <input id="data_base" type="date"
                                                   class="form-control @error('data_base') is-invalid @enderror"
                                                   name="data_base"
                                                   value="{{  isset($roadmap->data_base)?$roadmap->data_base:old('data_base')  }}"
                                                   required autocomplete="data_base">

                                            @error('data_base')
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
                    {{-- Aba Priorização --}}
                    <div class="tab-pane fade" id="pills-priorizacao" role="tabpanel"
                         aria-labelledby="pills-principal-tab">

                    </div>
                    {{-- Aba Alocação --}}
                    <div class="tab-pane fade" id="pills-alocacao" role="tabpanel"
                         aria-labelledby="pills-principal-tab">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endauth
