@extends('layouts.header')

<body class="hold-transition login-page">
  <nav>
    <li class="nav-item d-none d-sm-inline-block">
      @if(app()->getLocale()=='en')
      <a href="{{ route('change-lang','ar') }}" class="nav-link"> <i class="fas fa-language"></i> عربي </a>
      @else
      <a href="{{ route('change-lang','en') }}" class="nav-link"> <i class="fas fa-language"> </i> English</a>
      @endif
    </li>
  </nav>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h3"><b>{{ __('messages.sofra_dash')}}</a>
    </div>
    <div class="card-body">
        @include('inc.success_error_msg')


      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="{{ __('messages.email') }}" value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="{{ __('messages.password') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name='remember'>
              <label for="remember">
                {{ __('messages.remember_me') }}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('messages.signin') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

@extends('layouts.footer')

