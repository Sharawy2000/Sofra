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
                <form action="{{ route('settings.update',$setting->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.about')}}</label>
                        <textarea name="about_app" class="form-control" id="exampleInputPassword1" cols="30">{{ $setting->about_app }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.commission_rate') }}</label>
                        <input type="text" name="commission_rate" class="form-control" id="exampleInputPassword" min="1" max="5" value="{{ $setting->commission_rate }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.order_text') }}</label>
                        <textarea name="order_text" class="form-control" id="exampleInputPassword1" cols="30">{{ $setting->order_text }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.offer_text') }}</label>
                        <textarea name="offer_text" class="form-control" id="exampleInputPassword1" cols="30">{{ $setting->offer_text }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.commission_text') }}</label>
                        <textarea name="commission_text" class="form-control" id="exampleInputPassword1" cols="30">{{ $setting->commission_text }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.app_title') }}</label>
                        <input type="text" name="app_title" class="form-control" id="exampleInputPassword" value="{{ $setting->app_title }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.android_link') }}</label>
                        <input type="text" name="android_link" class="form-control" id="exampleInputPassword" value="{{ $setting->android_link }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.ios_link') }}</label>
                        <input type="text" name="ios_link" class="form-control" id="exampleInputPassword" value="{{ $setting->ios_link }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.bank_account_FN') }}</label>
                        <input type="text" name="bank_account_FN" class="form-control" id="exampleInputPassword" value="{{ $setting->bank_account_FN }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.bank_account_SN') }}</label>
                        <input type="text" name="bank_account_SN" class="form-control" id="exampleInputPassword" value="{{ $setting->bank_account_SN }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('messages.who_are_us') }}</label>
                        <textarea name="who_are_us" class="form-control" id="exampleInputPassword1" cols="30">{{ $setting->who_are_us }}</textarea> 
                    </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                  </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
