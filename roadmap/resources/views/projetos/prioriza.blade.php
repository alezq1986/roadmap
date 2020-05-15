@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@auth

@section('content')
    <div class="container">
        <div id="projetos-prioriza">
            @foreach($projetos as $projeto)
                <div class="row projeto-card">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">{{ $projeto->descricao }}</div>
                                <div class="col-md-4">{{ $equipes->find($projeto->equipe_id)->descricao }}</div>
                            </div>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@endauth

