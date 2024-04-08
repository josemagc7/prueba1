<!-- Navigation -->
<h6 class="navbar-heading text-muted">
    @if (auth()->user()->rol == 'admin')
    Gestiones
    @else
    Menu
    @endif
</h6>
<ul class="navbar-nav">
@if (auth()->user()->rol == 'admin')
    <li class="nav-item">
    <a class="nav-link" href="{{ route('home')}}">
        <i class="ni ni-tv-2 text-red"></i> Dashboard
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('tratamientos') }}">
        <i class="ni ni-atom text-blue"></i>Tratamientos
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('peluqueros') }}">
        <i class="ni ni-single-02 text-pink"></i> Peluqueros/as
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('clientes') }}">
        <i class="ni ni-satisfied text-info"></i> Clientes
    </a>
    </li>
@elseif (auth()->user()->rol == 'peluquero')
    <li class="nav-item">
        <a class="nav-link" href="/horario">
            <i class="ni ni-calendar-grid-58 text-blue"></i> Gestionar horario
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('tratamientos') }}">
            <i class="ni ni-time-alarm text-orange"></i>Mis citas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('clientes') }}">
            <i class="ni ni-satisfied text-info"></i> Mis clientes
        </a>
    </li>
@elseif (auth()->user()->rol == 'cliente')
<li class="nav-item">
    <a class="nav-link" href="{{ url('citas/create')}}">
        <i class="ni ni-calendar-grid-58 text-blue"></i> Resevar cita
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('tratamientos') }}">
        <i class="ni ni-time-alarm text-orange"></i>Mis citas
    </a>
</li>
@endif


  <!-- CERRAR SESION MENU LATERAL -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
      <i class="ni ni-key-25"></i> Cerrar sesión
    </a>
    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
      @csrf
    </form>
  </li>

</ul>

@if (auth()->user()->rol == 'admin')
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted">Estadisticas</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="ni ni-sound-wave text-yellow"></i>Freceuncias de citas
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="ni ni-spaceship text-orange"></i>Peluqeros/as más activos
    </a>
  </li>
</ul>
@endif

