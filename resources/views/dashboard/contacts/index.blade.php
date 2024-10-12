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
            <h1>{{ __('messages.contact_msg_table') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home')}}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.contact_msg_table') }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @include('inc.success_error_msg')

        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              {{-- <div class="card-header">
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <form id="form-search" action="{{ route('contacts.index') }}" method="GET">
                      @csrf
                    </form>
                    <input type="text" name="search" class="form-control float-right" form="form-search" placeholder="{{ __('messages.search') }}">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default" form="form-search">
                        <i class="fas fa-search"></i>
                      </button>
                      <a href="{{ route('contacts.index') }}" class="btn btn-default" form="form-search">
                        <i class="fas fa-times"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div> --}}
              <!-- ./card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('messages.email') }}</th>
                        <th>{{ __('messages.phone') }}</th>
                        <th>{{ __('messages.actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($contacts as $contact )  
                    
                    <tr data-widget="expandable-table" aria-expanded="true">
                        <td>{{ $contact->id }}</td>
                        {{-- <td><a href="{{ route('clients.show',$contact->client->id) }}">{{ $contact->client->id }}</a></td> --}}
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>
                            {{-- <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary">Edit</a> --}}
                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                                style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure ?');" class="btn btn-danger">{{__('messages.delete')}}</button>
                            </form>
                          </td>

                    </tr>
                    <tr class="expandable-body">
                      <td colspan="5">
                        <p>
                            <div>{{ __('messages.messgae') }} : {{ $contact->message }}</div>
                            
                        </p>
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
        @include('inc.paginator', ['paginator' => $contacts])
          
        </div> 
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   

</div>
<!-- ./wrapper -->

@endsection
