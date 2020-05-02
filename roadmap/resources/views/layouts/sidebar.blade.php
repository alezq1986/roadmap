@auth
    <div class="card">
        <div class="card-header">{{ __('Menu') }}</div>

        <div class="card-body">
            <ul>
                <li>
                    <a href="{{ route('recursos.index')}}">Recursos</a>
                </li>
                <li>
                    <a href="{{ route('competencias.index')}}">Competencias</a>
                </li>
            </ul>
        </div>
    </div>
@endauth
