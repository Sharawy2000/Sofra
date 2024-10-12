<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
  
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('dashboard') }}" class="nav-link"> <i class="fas fa-home"></i> {{__('messages.home')}}</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        {{-- <a href="#" class="nav-link">Contact</a> --}}
      </li>
      {{-- create logout button with an icon in right page --}}
      
    </ul>
    <ul>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i class="fas fa-sign-out-alt">  </i>{{ __('messages.logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf
        </form>
      </li>
      {{-- chnage lang and icon --}}
      <li class="nav-item d-none d-sm-inline-block">
        @if(app()->getLocale()=='en')
        <a href="{{ route('change-lang','ar') }}" class="nav-link"> <i class="fas fa-language"></i> عربي </a>
        @else
        <a href="{{ route('change-lang','en') }}" class="nav-link"> <i class="fas fa-language"> </i> English</a>
        @endif
      </li>
    </ul>
  </nav>