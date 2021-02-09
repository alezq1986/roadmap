@auth
    <div class="card">
        <div class="card-header">{{ __('Menu') }}</div>

        <div class="card-body">
            <ul>
                <li>
                    <a href="{{ route('clientes.index')}}">Clientes</a>
                </li>
                <li>
                    <a href="{{ route('recursos.index')}}">Recursos</a>
                </li>
                <li>
                    <a href="{{ route('competencias.index')}}">Competencias</a>
                </li>
                <li>
                    <a href="{{ route('equipes.index')}}">Equipes</a>
                </li>
                <li>
                    <a href="{{ route('projetos.index')}}">Projetos`</a>
                </li>
                <li>
                    <a href="{{ route('roadmaps.index')}}">Roadmaps</a>
                </li>
                <li>
                    <a href="{{ route('relatorios.dashboard')}}">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
@endauth
