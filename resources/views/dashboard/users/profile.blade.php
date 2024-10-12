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
            <h1>{{ __('messages.admin_profile') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.admin_profile') }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset("admin/dist/img/admin.png") }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">
                  @foreach ($user->getRoleNames() as $name )
                  @if ($name == 'Super-Admin')
                  <span class="badge badge-danger">{{ $name }}</span>
                  @elseif(in_array($name,['Leader','Maneger']))
                  <span class="badge badge-warning">{{ $name }}</span>
                  @else
                  <span class="badge badge-success">{{ $name }}</span>
                  @endif
                  @endforeach  
                </p>

                {{-- <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul> --}}

                {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            {{-- <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div> --}}
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  {{-- <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li> --}}
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">{{ __('messages.profile_update') }}</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">{{ __('messages.change_password') }}</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- /.tab-pane -->
                  {{-- Update Profile --}}
                  <div class="active tab-pane" id="settings">
                    @include('inc.success_error_msg')
                    <form class="form-horizontal" method="post" action="{{ route('profile-update') }}" >
                      @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">{{ __('messages.name') }}</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" class="form-control" id="inputName" value="{{ $user->name }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">{{ __('messages.email') }}</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" class="form-control" id="inputName" value="{{ $user->email }}">
                        </div>
                      </div>
        
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">{{ __('messages.current_password') }}</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control" id="inputName">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  {{-- Change Password --}}
                  <div class="tab-pane" id="timeline">
                    @include('inc.success_error_msg')
                    <form class="form-horizontal"  method="post" action="{{ route('change-password') }}">
                      @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">{{ __('messages.current_password') }}</label>
                        <div class="col-sm-10">
                          <input type="password" name="old_password" class="form-control" id="inputName">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">{{ __('messages.new_password') }}</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control" id="inputName" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">{{ __('messages.new_password_confirmation') }}</label>
                        <div class="col-sm-10">
                          <input type="password" name="password_confirmation" class="form-control" id="inputName">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

@endsection
