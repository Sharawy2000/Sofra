@extends('layouts.layout')
@inject('client','App\Models\Client' )
@inject('restaurant','App\Models\Restaurant' )
@inject('user','App\Models\User' )
@inject('contact','App\Models\ContactMessage' )
@inject('product','App\Models\Product' )
@inject('order','App\Models\Order' )
@inject('payment','App\Models\Payment' )
@inject('city','App\Models\City' )
@inject('category','App\Models\Category' )
@inject('neighborhood','App\Models\Neighborhood' )
@section('body')
<!-- Content Wrapper. Contains page content -->
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>{{ __('messages.dashboard') }}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.dashboard') }}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

    <!-- Main content -->
    
    <!-- /.content -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <!-- Info boxes -->
         <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{ __('messages.clients') }}</span>
                <span class="info-box-number">
                  {{ $client->count() }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
  
          {{-- <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div> --}}

          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-utensils"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{ __('messages.restaurants') }}</span>
                <span class="info-box-number">{{ $restaurant->count() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{ __('messages.users') }}</span>
                <span class="info-box-number">{{ $user->count() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-receipt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{ __('messages.orders') }}</span>
                <span class="info-box-number">{{ $order->count() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">{{ __('messages.monthly_recap_report') }}</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>{{ __('messages.goal_completion') }}</strong>
                    </p>

                    <div class="progress-group">
                      {{ __('messages.add_products_to_cart') }}
                      <span class="float-right"><b>{{ $order->where('status',0)->count() }}</b>/{{ $order->count() }}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: {{ ($order->where('status',0)->count() / $order->count()) * 100 }}%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      {{ __('messages.complete_purchase') }}
                      <span class="float-right"><b>{{ $order->where('status',3)->count() }}</b>/{{ $order->count() }}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: {{ ($order->where('status',3)->count() / $order->count()) * 100 }}%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      {{ __('messages.send_inquiries') }}
                      <span class="float-right"><b>{{ $contact->where('type',3)->count() }}</b>/{{ $contact->count() }}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: {{ ($contact->where('type',3)->count() / $contact->count()) * 100 }}%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> {{ round(($payment->pluck('amount_paid')->sum()/ $order->where('status',3)->pluck('commission_amount')->sum()) * 100 )}}%</span>
                      <h5 class="description-header">${{ $payment->pluck('amount_paid')->sum() }}</h5>
                      <span class="description-text">{{ __('messages.total_revenue') }}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">${{ $order->where('status',3)->pluck('total_price')->sum() }}</h5>
                      <span class="description-text">{{__('messages.total_cost')}}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> {{ round(($order->where('status',3)->pluck('commission_amount')->sum() / $order->where('status',3)->pluck('total_price')->sum()) * 100 )}}%</span>
                      <h5 class="description-header">${{ $order->where('status',3)->pluck('commission_amount')->sum() }}</h5>
                      <span class="description-text">{{ __('messages.total_profit') }}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                      <h5 class="description-header">1200</h5>
                      <span class="description-text">{{ __('messages.goal_compilations') }}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            
            <!-- /.card -->
            <div class="row">

              <div class="col-md-12">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">{{ __('messages.latest_clients') }}</h3>

                    <div class="card-tools">
                      <span class="badge badge-danger">4 New Members</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      @foreach ($client->latest()->take(4)->get() as $client )
                      <li>
                        <img src="{{ url("$client->image") }}" alt="User Image">
                        <a class="users-list-name">{{ $client->name }}</a>
                        <span class="users-list-date">{{ $client->created_at->diffForHumans()  }}</span>
                      </li>
                      @endforeach

                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="{{ route('clients.index') }}">{{ __('messages.view_clients') }}</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.card -->
            <div class="row">

              <div class="col-md-12">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">{{ __('messages.latest_restaurants') }}</h3>

                    <div class="card-tools">
                      <span class="badge badge-danger">4 New Members</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      @foreach ($restaurant->latest()->take(4)->get() as $restaurant )
                      <li>
                        <img src="{{ url("$restaurant->image") }}" alt="User Image">
                        <a class="users-list-name" href="{{ route('restaurants.show',$restaurant->id) }}">{{ $restaurant->name }}</a>
                        <span class="users-list-date">{{ $restaurant->created_at->diffForHumans()  }}</span>
                      </li>
                      @endforeach

                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="{{ route('restaurants.index') }}">{{ __('messages.view_restaurants') }}</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->


            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">{{ __('messages.latest_orders') }}</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>{{ __('messages.order_id') }}</th>
                      <th>{{ __('messages.item') }}</th>
                      <th>{{ __('messages.status') }}</th>
                      {{-- <th>Popularity</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($order->latest()->take(5)->get() as $order )
                        
                      <tr>
                        <td><a href="{{ route('orders.show',$order->id) }}">{{ $order->id }}</a></td>
                        <td>
                          @foreach ($order->products()->take(1)->get() as $pd )
                            {{ $pd->name }}
                          @endforeach
                        </td>
                        @if($order->status->name == 'DELIVERED')

                        <td><span class="badge badge-success">{{ $order->status->name }}</span></td>

                        @elseif($order->status->name =='CANCELLED')

                        <td><span class="badge badge-danger">{{ $order->status->name }}</span></td>

                        @elseif($order->status->name =='PENDING')

                        <td><span class="badge badge-warning">{{ $order->status->name }}</span></td>

                        @else

                        <td><span class="badge badge-info">{{ $order->status->name }}</span></td>

                        @endif
                        
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{ route('orders.index') }}" class="btn btn-sm btn-secondary float-right">{{ __('messages.view_orders') }}</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-boxes"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{ __('messages.products') }}</span>
                <span class="info-box-number">{{ $product->count() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="fas fa-city"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{ __('messages.cities') }}</span>
                <span class="info-box-number">{{ $city->count() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-list-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{ __('messages.categories') }}</span>
                <span class="info-box-number">{{ $category->count() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="far fa-comment"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{ __('messages.contact_msg') }}</span>
                <span class="info-box-number">{{ $contact->count() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>

            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-map-marker-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{ __('messages.neighborhoods') }}</span>
                <span class="info-box-number">{{ $neighborhood->count() }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ __('messages.recent_products') }}</h3>
    
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  @foreach ( $product::latest()->take(5)->get() as $product )
                    
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
              <!-- /.card-body -->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection