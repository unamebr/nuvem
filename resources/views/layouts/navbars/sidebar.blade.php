<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a  class="simple-text logo-normal">
      {{ __('Cloud Project') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      @if(Auth::user()->isAdmin())
      <li class="nav-item{{ $activePage == 'admin-area' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.area') }}">
          <i class="material-icons">assessment</i>
            <p>{{ __('Admin Area') }}</p>
        </a>
      </li>
      @endif
      @if(Auth::user()->isAdmin())
      <li class="nav-item{{ $activePage == 'admin-area-requests' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.area.requests') }}">
          <i class="material-icons">assessment</i>
            <p>{{ __('Solicitações') }}</p>
        </a>
      </li>
      @endif
      <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('profile.edit') }}">
          <i class="material-icons">account_circle</i>
            <span class="sidebar-normal">{{ __('User profile') }} </span>
        </a>
      </li>
      @if (Auth::user()->isAdmin())
      <li class="nav-item{{ $activePage == 'user-machines' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.machines') }}">
          <i class="material-icons">dvr</i>
            <span class="sidebar-normal"> {{ __('Machines') }} </span>
        </a>
      </li>          
      @endif
      @if(Auth::user()->isAdmin())
      <li class="nav-item{{ $activePage == 'images' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('images.index') }}">
            <i class="fab fa-docker"></i>
            <span class="sidebar-normal"> {{ __('Images') }} </span>
        </a>
      </li>
      @endif 
      @if(Auth::user()->isAdmin())
      <li class="nav-item{{ $activePage == 'my-containers' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('instance.index') }}">
            <i class="fas fa-server"></i>
            <span class="sidebar-normal"> {{ __('My Containers') }} </span>
        </a>
      </li>
      @endif
      @if(Auth::user()->isAdmin())
      <li class="nav-item{{ $activePage == 'dockerfiles' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.area.dockerfiles') }}">
            <i class="fas fa-server"></i>
            <span class="sidebar-normal"> {{ __('Dockerfiles') }} </span>
        </a>
      </li>
      @endif
      @if(Auth::user()->isBasic() || Auth::user()->isAdmin())
      <li class="nav-item{{ $activePage == 'dockerfiles' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('aluno.basic.index') }}">
            <i class="fas fa-star-half-alt"></i>
            <span class="sidebar-normal"> {{ __('Basic') }} </span>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'dockerfiles' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('aluno.basic.containers') }}">
            <i class="fas fa-server"></i>
            <span class="sidebar-normal"> {{ __('Containers') }} </span>
        </a>
      </li>
      {{-- <li class="nav-item{{ $activePage == 'basic' ? ' active' : '' }}">
        <div class="container">
          <div class="row">
            <div class="col-8 pl-5" >
              <a class="nav-link"  href="{{ route('aluno.basic.index') }}" >
                <i class="fas fa-server "></i>
                <span class="sidebar-normal"> {{ __('Basic') }} </span>
              </a>
            </div>
            <div class="col-4">
              <a href="#" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                </svg>
              </a>
            </div>
          </div>
          
        </div>
          
          
          <div class="collapse" id="collapseExample">
            <a class="nav-link" href="{{ route('aluno.basic.containers') }}" >
            <i class="fas fa-server"></i>
            <span class="sidebar-normal"> {{ __('Containers') }} </span>
          </a>           
          </div>
        
      </li> --}}
      @endif
      @if(Auth::user()->isAdvanced() || Auth::user()->isAdmin())
      <li class="nav-item{{ $activePage == 'advanced' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('aluno.advanced.index') }}">
            <i class="fas fa-star"></i>
            <span class="sidebar-normal"> {{ __('Advanced') }} </span>
        </a>
      </li>
      @endif
      <!-- <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Laravel Examples') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
          </ul>
        </div>
      </li> -->
      <!-- <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Table List') }}</p>
        </a>
      </li> -->
    </ul>
  </div>
</div>
