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
            <h1>{{ __('messages.clients_table')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.clients_table')}}</li>
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
              <div class="card-header">
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    {{-- form the search --}}
                    <form id="form-search" action="{{ route('clients.index') }}" method="GET">
                      @csrf
                    </form>
                    <input type="text" name="search" class="form-control float-right" form="form-search" placeholder="{{ __('messages.search') }}">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default" form="form-search">
                        <i class="fas fa-search"></i>
                      </button>
                      <a href="{{ route('clients.index') }}" class="btn btn-default" form="form-search">
                        <i class="fas fa-times"></i>
                      </a>
                     
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>{{ __('messages.client') }}</th>
                      <th>{{ __('messages.phone') }}</th>
                      <th>{{ __('messages.email') }}</th>
                      <th>{{ __('messages.neighborhood') }}</th>
                      <th>{{ __('messages.city') }}</th>
                      <th>{{ __('messages.isActivated') }}</th>
                      <th>{{ __('messages.actions') }}</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($clients as $client )  
                    <tr>
                      <td>{{ $client->id }}</td>
                      {{-- <td><a href="{{ route('clients.show',$client->id) }}">{{ $client->name }}</a></td> --}}
                      <td>{{ $client->name }}</td>
                      <td>{{ $client->phone }}</td>
                      <td>{{ $client->email }}</td>
                      <td>{{ $client->neighborhood->name }}</td>
                      <td>{{ $client->neighborhood->city->name }}</td>
                      <td>{{ $client->is_activated == 1 ? __("messages.yes") :  __('messages.no') }}</td>
                      <td>
                        {{-- <a href="{{ route('clients.update', $client->id) }}" class="btn btn-primary">{{ __('messages.edit') }}</a> --}}
                        <form action="{{ route('clients.update', $client->id) }}" method="POST"
                            style="display: inline-block">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_activated" value="{{ $client->is_activated == 1 ? 0 : 1 }}">
                            <button type="submit" class="btn btn-{{ $client->is_activated==1 ? 'danger' : 'success' }}">{{ $client->is_activated == 1 ?  __("messages.de_activate") : __("messages.activate") }}</button>
                        </form>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                            style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            {{-- <button type="submit" onclick="return confirm('Are you sure ?');" class="btn btn-danger">{{ __('messages.delete') }}</button> --}}
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
        @include('inc.paginator', ['paginator' => $clients])
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   

</div>
<!-- ./wrapper -->

@endsection
