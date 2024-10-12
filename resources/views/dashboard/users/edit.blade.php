@extends('layouts.layout')
@section('body')
@inject('roles','Spatie\Permission\Models\Role' )
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>{{ __('messages.users') }}</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}"><i class="fas fa-arrow-left"></i> {{ __('messages.back') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('messages.users') }}</li>
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
                  <h3 class="card-title">{{ __('messages.update')." ".__('messages.user') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('users.update',$user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.name') }}</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.email') }}</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.roles') }}</label>
                      <br>
                      @foreach($roles->all() as $role)
                        <div class="form-check" style="display: inline-block">
                          <input type="checkbox" name="role_list[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                          <label for="flexCheckDefault">
                            {{ $role->name }}
                          </label>  
                        </div>
                      @endforeach
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
@section('scripts')
<script>
  $(document).ready(function() {
      $('#form-select').select2();
  });
</script>
@endsection
