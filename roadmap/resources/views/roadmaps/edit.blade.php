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
                            {{ __('Atualizar') }}
                        </button>
                    </div>
                </div>
                {{-- Navegação --}}
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-principal-tab" data-toggle="pill" href="#pills-principal"
                           role="tab" aria-controls="pills-principal" aria-selected="true">Principal</a>
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
                                <form method="POST" id="form-principal"
                                      action="{{ route('roadmaps.update', $roadmap) }}">
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
                                        <label for="descricao"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>
                                        <div class="col-md-6">
                                            <input id="descricao" type="text"
                                                   class="form-control @error('descricao') is-invalid @enderror"
                                                   name="descricao"
                                                   value="{{ isset($roadmap->descricao)?$roadmap->descricao:old('descricao') }}"
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
                </div>
            </div>
        </div>
    </div>
@endsection
@endauth
