<div class="wrapper " style="background-color: #161920">
  @include('layouts.navbars.sidebar')
  <div class="main-panel" >
    @include('layouts.navbars.navs.auth')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>