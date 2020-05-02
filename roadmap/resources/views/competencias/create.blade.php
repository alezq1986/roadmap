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
                    <div class="card-header">{{ __('Cadastrar competencia') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('competencias.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="descricao"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Descricao') }}</label>

                                <div class="col-md-6">
                                    <input id="descricao" type="text"
                                           class="form-control @error('descricao') is-invalid @enderror"
                                           name="descricao" value="{{ old('descricao') }}" required
                                           autocomplete="descricao" autofocus>

                                    @error('descricao')
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
