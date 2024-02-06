
<li class="nav-item">
    <a href="{{ route('criptoMonedas.index') }}" class="nav-link {{ Request::is('criptoMonedas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Cripto Monedas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('transacciones.index') }}" class="nav-link {{ Request::is('criptomonedaTransaccions*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Criptomoneda Transaccions</p>
    </a>
</li>
