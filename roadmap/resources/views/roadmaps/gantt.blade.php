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
                <input id="roadmap" value="{{$roadmap->id}}" class="d-none" disabled>
                <div id="gantt"></div>

            </div>
        </div>
    </div>
@endsection

@section('scripts-especificos')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="{{ asset('js/roadmap-gantt.js') }}"></script>
    <link href="{{ asset('css/roadmap-gantt.css') }}" rel="stylesheet">

@endsection


@endauth
