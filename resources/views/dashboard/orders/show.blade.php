@extends('layouts.layout')
@section('styles')
<style>
  @media print {
      /* Hide the print button when printing */
      .no-print {
          display: none;
      }
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
            <h1>{{ __('messages.order')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('orders.index') }}"><i class="fas fa-arrow-left"></i> {{ __('messages.back') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('messages.home')}}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.order')}}</li>
            </ol>
          </div>
        </div>
        <div style="margin-left:1000px">
          <button onclick="printPage()" class="btn btn-primary no-print">
            <i class="fas fa-print"></i> {{ __('messages.print') }}
          </button>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{ __('messages.order')." #".$order->id }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-user mr-1"></i> {{ __('messages.client') }}</strong>
                
                <p>
                  
                  {{ $order->client->name }}
                </p>

                <hr>

                <strong><i class="fas fa-utensils mr-1"></i> {{ __('messages.restaurant') }}</strong>

                <p>{{ $order->restaurant->name}}</p>

                <hr>

                <strong><i class="fas fa-shopping-cart icon mr-1"></i> {{ __('messages.products') }}</strong>
                <br><br>
                <div class="row">
                  @foreach ($order->products->all() as $product)
                    <div class="col-sm-4 col-3">
                      <div class="description-block border-right">
                        <img src="{{ url("$product->image") }}" alt="" height="100" width="100"><br>
                        <span class="badge badge-danger">{{ $product->name }}</span><br>
                        <span class="badge badge-warning">{{ $product->pivot->quantity}}</span>
                        <span class="badge badge-primary">{{ $product->price_in_offer ?? $product->price }} EGP</span>
                        <span class="badge badge-success">{{ ($product->price_in_offer ?? $product->price) * $product->pivot->quantity }} EGP</span>    
                      </div>
                    </div>
                  @endforeach
                </div>
                <hr>

                <strong><i class="fas fa-credit-card mr-1"></i> {{ __('messages.paymentMethod') }}</strong>
                <p>{{ $order->paymentMethod->name}}</p>

                <hr>
                <strong><i class="fas fa-info-circle mr-1"></i> {{ __('messages.status') }}</strong>
                <p>{{ $order->status->name }}</p>

                <hr>
                <strong><i class="fas fa-truck mr-1"></i> {{ __('messages.delivery_fees') }}</strong>
                <p>{{ $order->restaurant->delivery_fees}} EGP</p>

                <hr>
                <strong><i class="fas fa-money-bill mr-1"></i> {{ __('messages.total_price') }}</strong>
                <p>{{ $order->total_price}} EGP</p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> {{ __('messages.notes') }}</strong>

                <p>{{ $order->notes }}</p>
              </div>
              <!-- /.card-body -->
            </div>
            
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
@section('scripts')
<script>
  function printPage() {
        window.print(); // This opens the print dialog for the current window
  }
</script>
@endsection