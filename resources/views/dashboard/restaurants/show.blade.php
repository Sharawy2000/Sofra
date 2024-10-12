@extends('layouts.layout')

@section('body')
@inject('product','App\Models\Product')

<div class="wrapper">
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('messages.profile') }}</h1>
          </div>
          {{-- make a back button with icon --}}
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('restaurants.index') }}"><i class="fas
                fa-arrow-left"></i> Back</a></li>
            </ol>
          </div> --}}

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('restaurants.index') }}"><i class="fas fa-arrow-left"></i> {{ __('messages.back') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.profile') }}</li>

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
                       src="{{ url("$restaurant->image") }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $restaurant->name }}</h3>

                <p class="text-muted text-center">{{ $restaurant->is_active == 1 ? __('messages.active') : __('messages.deactive') }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>{{ __('messages.orders') }}</b> <a class="float-right">{{ $restaurant->orders->count() }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>{{ __('messages.products') }}</b> <a class="float-right">{{ $restaurant->products->count() }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>{{ __('messages.offers') }}</b> <a class="float-right">{{ $restaurant->offers->count() }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>{{ __('messages.reviews') }}</b> <a class="float-right">
                      @for ($i = 1; $i <= 5; $i++)
                      @if ($i <= $restaurant->overall_rate)
                          <i class="fas fa-star" style="color: gold;"></i>
                      @else
                          <i class="fas fa-star" style="color: lightgray;"></i>
                      @endif
                  @endfor
                    </a>
                  </li>
                </ul>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{ __('messages.restaurant_info') }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> {{ __('messages.delivery_fees') }}</strong>

                <p class="text-muted">
                  {{ $restaurant->delivery_fees }} EGP
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> {{ __('messages.address') }}</strong>

                <p class="text-muted">{{ $restaurant->neighborhood->name . ", " . $restaurant->neighborhood->city->name  }}</p>

                <hr>
                <strong><i class="fas fa-phone mr-1"></i> {{ __('messages.contact_phone') }}</strong>

                <p class="text-muted">{{ $restaurant->contact_phone}}</p>

                <hr>
                <strong><i class="fab fa-whatsapp mr-1"></i> {{ __('messages.contact_whatsapp') }}</strong>

                <p class="text-muted">{{ $restaurant->contact_whatsapp}}</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> {{ __('messages.categories') }}</strong>

                <p class="text-muted">
                  @foreach ($restaurant->categories->all() as $cat)
                  <span class="badge badge-warning">{{ $cat->name }}</span>
                  @endforeach
                </p>
                <hr>
                <strong><i class="far fa-file-alt mr-1"></i> {{ __('messages.minimum_order') }}</strong>

                <p class="text-muted">{{ $restaurant->minimum_order }} EGP</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">{{ __('messages.products') }}</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  
                  <!-- /.tab-pane -->
                  <div class="active tab-pane" id="timeline">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                      @foreach ( $restaurant->products->all() as $product )
                        
                      <li class="item">
                        <div class="product-img">
                          <img src="{{ url("$product->image") }}" alt="Product Image" class="img-size-50">
                        </div>
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title">{{ $product->name }}
                            <span class="badge badge-warning float-right">${{ $product->price }}</span></a>
                          <span class="product-description">
                            {{ $product->description }}
                          </span>
                        </div>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
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

@endsection
