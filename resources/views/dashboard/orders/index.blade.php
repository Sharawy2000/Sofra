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
            <h1>{{ __('messages.orders_table')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.orders_table')}}</li>
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
                    <form id="form-search" action="{{ route('orders.index') }}" method="GET">
                      @csrf
                    </form>
                    <input type="text" name="search" class="form-control float-right" form="form-search" placeholder="{{ __('messages.search') }}">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default" form="form-search">
                        <i class="fas fa-search"></i>
                      </button>
                      <a href="{{ route('orders.index') }}" class="btn btn-default" form="form-search">
                        <i class="fas fa-times"></i>
                      </a>  
                    </div>
                  </div>
                </div>
              </div>
              <!-- ./card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('messages.client') }}</th>
                        <th>{{ __('messages.restaurant') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.total_price')}}</th>
                        <th>{{ __('messages.paymentMethod') }}</th>
                        <th>{{ __('messages.commission_amount') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order )  
                    
                    <tr data-widget="expandable-table" aria-expanded="true">
                        <td><a href="{{ route('orders.show',$order->id) }}">{{ $order->id }}</a></td>
                        <td>{{ $order->client->name }}</td>
                        <td><a href="{{ route('restaurants.show',$order->restaurant->id) }}">{{ $order->restaurant->name }}</a></td>
                        <td>{{ $order->status->name }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ $order->paymentMethod->name }}</td>
                        <td>{{ $order->commission_amount }}</td>
                    </tr>
                    <tr class="expandable-body">
                      <td colspan="7">
                        <p>
                            <div>{{ __('messages.notes') }} : {{ $order->notes }}</div>     
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
        @include('inc.paginator', ['paginator' => $orders])
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   

</div>
<!-- ./wrapper -->

@endsection
