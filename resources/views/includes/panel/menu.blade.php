<!-- Navigation -->
<h6 class="navbar-heading text-muted">
    @if (auth()->user()->rol == 'admin')
    Gestiones
    @else
    Menu
    @endif
</h6>
<ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link" href="{{ route('home')}}">
        <i class="ni ni-tv-2 text-red"></i> Inicio
    </a>
    </li>
@if (auth()->user()->rol == 'admin')
    <li class="nav-item">
    <a class="nav-link" href="{{ url('tratamientos') }}">
        <i class="ni ni-scissors text-blue"></i>Tratamientos
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('peluqueros') }}">
        <i class="ni ni-single-02 text-pink"></i> Peluqueros/as
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('clientes') }}">
        <i class="ni ni-circle-08 text-info"></i> Clientes
    </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('cajaAdmin') }}">
            <i class="ni ni-money-coins text-success"></i> Caja
        </a>
    </li>
@elseif (auth()->user()->rol == 'peluquero')
    <li class="nav-item">
        <a class="nav-link" href="/horario">
            <i class="ni ni-time-alarm text-blue"></i> Gestionar horario
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('citasPeluquero') }}">
            <i class="ni ni-bullet-list-67 text-orange"></i>Planificación de citas
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-like-2 text-success"></i>Tratamientos finalizados
        </a>
    </li> --}}
@elseif (auth()->user()->rol == 'cliente')
<li class="nav-item">
    <a class="nav-link" href="{{ url('citas/create')}}">
        <i class="ni ni-calendar-grid-58 text-blue"></i> Resevar cita
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('vercitas') }}">
        <i class="ni ni-bullet-list-67 text-orange"></i>Mis citas
    </a>
</li>
@endif


  <!-- CERRAR SESION MENU LATERAL -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
      <i class="ni ni-user-run"></i> Cerrar sesión
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
    <a class="nav-link" href="#" @disabled(true)>
      <i class="ni ni-sound-wave text-yellow"></i>Freceuncias de citas
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#" @disabled(true)>
      <i class="ni ni-spaceship text-orange"></i>Peluqeros/as más activos
    </a>
  </li>
</ul>
@endif

