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
                  <h3 class="card-title">{{ __('messages.create')." ".__('messages.user') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.name') }}</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.email') }}</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.password') }}</label>
                      <input type="password" name="password" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.password_confirmation') }}</label>
                      <input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1" >
                    </div>
                    {{-- <div class="form-group">
                        <label for="role_id">{{ __('messages.roles') }}</label>
                        <select name="role_list[]" class="form-control" id="form-select" multiple="multiple" dataplaceholder="Select a Role">
                            @foreach($roles->all() as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select> 
                    </div> --}}
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.roles') }}</label><hr>

                      <div class="form-check" >
                        <input class="form-check-input" id="selectAll" type="checkbox">
                          {{ __('messages.select_all') }}
                      </div>
                      <br>
                      @foreach($roles->all() as $role)
                        <div class="form-check" style="display: inline-block">
                          <input type="checkbox" name="role_list[]" value="{{ $role->id }}" >
                          <label for="flexCheckDefault">
                            {{ $role->name }}
                          </label>  
                        </div>
                      @endforeach
                    </div>
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
{{-- <script>
    $(document).ready(function() {
        $('#form-select').select2();
    });
</script> --}}
@include('inc.select-all')
@endsection
