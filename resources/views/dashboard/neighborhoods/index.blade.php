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
            <h1>{{__('messages.neighborhoods_table') }}</h1>
            <a href="{{ route('neighborhoods.create') }}" style="margin-top: 30px; " class="btn btn-primary">{{__('messages.create')." ".__('messages.neighborhood') }}</a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('messages.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('messages.neighborhoods_table')}}</li>
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
                    <input type="text" name="table_search" class="form-control float-right" placeholder="{{ __('messages.search') }}">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
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
                      <th>{{ __('messages.name') }}</th>
                      <th>{{ __('messages.city') }}</th>
                      <th>{{ __('messages.actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($neighborhoods as $neighborhood )  
                    <tr>
                      <td>{{  $neighborhood->id }}</td>
                      <td>{{  $neighborhood->name }}</td>
                      <td>{{  $neighborhood->city->name }}</td>
                      <td>
                        <a href="{{ route('neighborhoods.edit', $neighborhood->id) }}" class="btn btn-primary">{{ __('messages.edit') }}</a>
                        <form action="{{ route('neighborhoods.destroy', $neighborhood->id) }}" method="POST"
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
          {{-- Pagination Links --}}
        @include('inc.paginator', ['paginator' => $neighborhoods])
        {{-- {{ $neighborhoods->links() }} --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   

</div>
<!-- ./wrapper -->

@endsection
