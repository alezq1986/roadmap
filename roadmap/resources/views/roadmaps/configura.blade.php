@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@auth

@section('content')


    <div class="bs-stepper linear" id="roadmap-stepper">
        <div class="bs-stepper-header" role="tablist">
            <!-- your steps here -->
            <div class="step active" data-target="#selecao-projetos">
                <button type="button" class="step-trigger" role="tab" aria-controls="selecao-projetos"
                        id="selecao-projetos-trigger">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label">Seleção</span>
                </button>
            </div>
            <div class="bs-stepper-line"></div>
            <div class="step" data-target="#priorizacao-projetos">
                <button type="button" class="step-trigger" role="tab" aria-controls="priorizacao-projetos"
                        id="priorizacao-projetos-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">Priorização</span>
                </button>
            </div>
            <div class="bs-stepper-line"></div>
            <div class="step" data-target="#alocacao-projetos">
                <button type="button" class="step-trigger" role="tab" aria-controls="alocacao-projetos"
                        id="alocacao-projetos-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">Alocação</span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">
            <!-- your steps content here -->
            <div id="selecao-projetos" class="bs-stepper-pane active dstepper-block" role="tabpanel"
                 aria-labelledby="selecao-projetos-trigger">


                <button class="btn btn-primary next">Próximo</button>
            </div>
            <div id="priorizacao-projetos" class="bs-stepper-pane" role="tabpanel"
                 aria-labelledby="priorizacao-projetos-trigger">
                <div class="container">
                    <div id="projetos-prioriza">
                        @foreach($projetos as $projeto)
                            <div class="row projeto-card" projeto-prioridade="{{ $projeto->id }}">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-4">{{ $projeto->descricao }}</div>
                                            <div
                                                class="col-md-4">{{ $equipes->find($projeto->equipe_id)->descricao }}</div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button class="btn btn-primary previous">Anterior</button>
                <button class="btn btn-primary next">Próximo</button>
            </div>
            <div id="alocacao-projetos" class="bs-stepper-pane" role="tabpanel"
                 aria-labelledby="alocacao-projetos-trigger">
                <button class="btn btn-primary previous">Anterior</button>
            </div>
        </div>
    </div>



@endsection

@endauth

