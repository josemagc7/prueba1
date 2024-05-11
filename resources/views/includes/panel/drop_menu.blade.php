<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">

              <a href="{{ url('miPerfil') }}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Mi perfil</span>
              </a>
              @if (auth()->user()->rol == 'cliente')
              <a href="{{url('vercitas')}}" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Mis citas</span>
              </a>
              @endif

              {{-- <a href="{{ url('miPerfil/ajustes') }}" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Ajustes</span>
              </a> --}}
              {{-- <a href="#" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Ayuda</span>
              </a> --}}
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout')}}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
                <i class="ni ni-user-run"></i>
                <span>Cerrar sesión</span>
              </a>
              <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
                @csrf
              </form>
            </div>
