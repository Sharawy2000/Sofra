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
            <h1>{{ __('messages.UsersTable') }}</h1>
            <a href="{{ route('users.create') }}" style="margin-top: 30px; " class="btn btn-primary">{{ __('messages.create')." ".__('messages.user') }}</a>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.UsersTable') }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @include('inc.success_error_msg')
        <div class="row">
          <div class="col-12">
            <div class="card">
              {{-- <div class="card-header">
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <form id="form-search" action="{{ route('users.index') }}" method="GET">
                      @csrf
                    </form>
                    <input type="text" name="search" class="form-control float-right" form="form-search" placeholder="{{ __('messages.search') }}">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default" form="form-search">
                        <i class="fas fa-search"></i>
                      </button>
                      <a href="{{ route('users.index') }}" class="btn btn-default" form="form-search">
                        <i class="fas fa-times"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div> --}}
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>{{ __('messages.user') }}</th>
                      <th>{{ __('messages.email') }}</th>
                      <th>{{ __('messages.role') }}</th>
                      <th>{{ __('messages.actions') }}</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user )  
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td><a href="{{ route('users.show',$user->id) }}">{{ $user->name }}</a></td>
                      <td>{{ $user->email }}</td>
                      <td>
                      @foreach ($user->getRoleNames() as $name )
                        @if ($name == 'Super-Admin')
                        <span class="badge badge-danger">{{ $name }}</span>
                        @elseif(in_array($name,['Leader','Maneger']))
                        <span class="badge badge-warning">{{ $name }}</span>
                        @else
                        <span class="badge badge-success">{{ $name }}</span>
                        @endif
                      @endforeach  
                      </td>
                      <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">{{ __('messages.edit') }}</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                            style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure ?');" class="btn btn-danger">{{ __('messages.delete') }}</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        @include('inc.paginator', ['paginator' => $users])
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   

</div>
<!-- ./wrapper -->

@endsection
