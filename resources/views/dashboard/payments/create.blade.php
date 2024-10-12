@extends('layouts.layout')
@section('body')
@inject('restaurant', 'App\Models\Restaurant')
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>{{ __('messages.payments') }}</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('payments.index') }}"><i class="fas fa-arrow-left"></i> {{ __('messages.back') }}</a></li>

                    <li class="breadcrumb-item"><a href="#">{{ __('messages.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('messages.payments') }}</li>
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
                  <h3 class="card-title">{{ __('messages.create')." ".__('messages.payment') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{ route('payments.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                  <div class="card-body">

                    <div class="form-group">
                      <label for="exampleInputPassword1">{{ __('messages.restaurant') }}</label>
                      <select name="restaurant_id" class="form-control" id="category_id">
                        @foreach ($restaurant->all() as $restaurant)
                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.amount_paid') }}</label>
                      <input type="text" name="amount_paid" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.payment_date') }}</label>
                      <input type="date" name="payment_date" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.notes') }}</label>
                      {{-- <input type="text" name="notes" class="form-control" id="exampleInputEmail1" > --}}
                      <textarea name="notes" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.name') }}</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" >
                    </div> --}}
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('messages.create') }}</button>
                  </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
