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
                <h1>{{ __('messages.payment_methods') }}</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('payment-methods.index') }}"><i class="fas fa-arrow-left"></i> {{ __('messages.back') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('messages.payment-methods') }}</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="card card-primary">
              @include('inc.success_error_msg')
                <div class="card-header">
                  <h3 class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('payment-methods.update',$paymentMethod->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.name') }}</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{ $paymentMethod->name }}">
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
