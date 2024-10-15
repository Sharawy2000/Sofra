@extends('layouts.layout')
@section('styles')
{{-- @inject('permission','App\' ) --}}
@inject('permission','Spatie\Permission\Models\Permission' )

<style>
  #checkbox-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
  }

  #checkbox-container label {
      display: flex;
      align-items: center;
  }

</style>
@endsection
@section('body')
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>{{ __('messages.roles') }}</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}"><i class="fas fa-arrow-left"></i> {{ __('messages.back') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('messages.roles') }}</li>
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
                  <h3 class="card-title">{{ __('messages.create')." ".__('messages.roles') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.name') }}</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    <label for="exampleInputEmail1">{{ __('messages.permissions') }}</label>
                    
                    <div class="form-group" id="checkbox-container">
                      <div class="form-check">
                        <input id="selectAll" type="checkbox">
                          {{ __('messages.select_all') }}
                      </div>
                      <hr>
                      <br>
                      <hr>
                      @foreach($permission->all() as $permission)
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                          {{ $permission->name }}
                        </div>
                      @endforeach
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
@section('scripts')
@include('inc.select-all')
@endsection
