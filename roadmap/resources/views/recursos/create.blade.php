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
                <div class="card">
                    <div class="card-header">{{ __('Cadastrar recurso') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('recursos.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="nome" type="text"
                                           class="form-control @error('nome') is-invalid @enderror" name="nome"
                                           value="{{ old('nome') }}" required autocomplete="nome" autofocus>

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
                                           name="data_inicio" value="{{ old('data_inicio') }}" required
                                           autocomplete="data_inicio">

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
                                           class="form-control @error('data_fim') is-invalid @enderror" name="data_fim"
                                           value="{{ old('data_fim') }}" required autocomplete="data_fim">

                                    @error('data_fim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Cadastrar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endauth
