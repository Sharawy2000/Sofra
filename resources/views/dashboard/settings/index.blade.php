@extends('layouts.layout')
@section('body')
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>{{ __('messages.settings') }}</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="{{ route('settings.index') }}"><i class="fas fa-arrow-left"></i> Back</a></li> --}}
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('messages.settings') }}</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="card card-primary">
              @include('inc.success_error_msg')
                {{-- <div class="card-header"> --}}
                  {{-- <h3 class="card-title">Update an setting</h3> --}}
                {{-- </div> --}}
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{ route('settings.update',1) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.notify_title_setting') }}</label>
                      <input type="text" name="notification_setting_title" class="form-control" id="exampleInputEmail1" value="{{ $setting->notification_setting_title }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">{{ __('messages.about')." ".__('messages.app') }}</label>
                      <textarea type="password" name="about_app" class="form-control" id="exampleInputPassword1" cols="30">{{ $setting->about_app }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">{{ __('messages.rate') }}</label>
                      <input type="number" name="rate" class="form-control" id="exampleInputPassword" min="1" max="5" value="{{ $setting->rate }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">{{ __('messages.phone') }}</label>
                      <input type="text" name="phone" class="form-control" id="exampleInputPassword" value="{{ $setting->phone }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">{{ __('messages.email') }}</label>
                      <input type="email" name="email" class="form-control" id="exampleInputPassword" value="{{ $setting->email }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">{{ __('messages.facebook') }}</label>
                      <input type="test" name="facebook_link" class="form-control" id="exampleInputPassword" value="{{ $setting->facebook_link }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.twitter') }}</label>
                        <input type="text" name="twitter_link" class="form-control" id="exampleInputPassword" value="{{ $setting->twitter_link }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.instagram') }}</label>
                        <input type="text" name="instagram_link" class="form-control" id="exampleInputPassword" value="{{ $setting->instagram_link }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.youtube') }}</label>
                        <input type="text" name="youtube_link" class="form-control" id="exampleInputPassword" value="{{ $setting->youtube_link }}">
                    </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                  </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
