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
            <h1>{{__('messages.offers_table') }}</h1>
            {{-- <a href="{{ route('offerss.create') }}" style="margin-top: 30px; " class="btn btn-primary">{{__('messages.create')." ".__('messages.offer') }}</a> --}}
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('messages.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('messages.offers_table')}}</li>
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
                <div class="card-header">
                  <form id='search-form' action="{{ route('offers.index') }}" method="get">
                    @csrf
  
                  </form>
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="search" class="form-control float-right" placeholder="{{ __('messages.search') }}" form="search-form">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default" form="search-form">
                          <i class="fas fa-search"></i>
                        </button>
                        <a href="{{ route('offers.index') }}" class="btn btn-default" form="form-search">
                          <i class="fas fa-times"></i>
                        </a>
                      </div>
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
                      <th>{{ __('messages.name') }}</th>
                      <th>{{ __('messages.restaurant') }}</th>
                      <th>{{ __('messages.desc') }}</th>
                      <th>{{ __('messages.img') }}</th>
                      <th>{{ __('messages.date_begin') }}</th>
                      <th>{{ __('messages.date_end') }}</th>
                      <th>{{ __('messages.discount') }}</th>
                      <th>{{ __('messages.actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($offers as $offer )  
                    <tr>
                      <td>{{  $offer->id }}</td>
                      <td>{{  $offer->name }}</td>
                      <td>{{  $offer->restaurant->name }}</td>
                      <td>{{  $offer->description }}</td>
                      <td><img src="{{ url("$offer->image") }}" alt="No image" width='150' height = '75'></td>
                      <td>{{  $offer->date_begin }}</td>
                      <td>{{  $offer->date_end }}</td>
                      <td>{{  $offer->discount }}</td>
                      <td>
                        <form action="{{ route('offers.destroy', $offer->id) }}" method="POST"
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
        @include('inc.paginator', ['paginator' => $offers])
        {{-- {{ $offers->links() }} --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   

</div>
<!-- ./wrapper -->

@endsection
