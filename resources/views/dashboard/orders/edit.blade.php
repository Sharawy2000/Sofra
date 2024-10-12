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
                <h1>{{ __('messages.clients') }}</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('clients.index') }}"><i class="fas fa-arrow-left"></i> {{ __('messages.back') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('messages.clients') }}</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        
        <section class="content">
            <div class="card card-primary">
              @include('inc.success_error_msg')
                <div class="card-header">
                  <h3 class="card-title">{{ __('messages.update')." ".__('messages.client') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('clients.update',$client->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{ __('messages.name') }}</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{ $client->name }}">
                    </div>
                    <div class="form-group">
                        <label for="city_id">{{ __('messages.city') }}</label>
                        <select name="city_id" class="form-control" id="city_id" value="{{ $client->city->id }}">
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ $city->id == $client->city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="blood_type_id">{{ __('messages.blodtype') }}</label>
                        <select name="blood_type_id" class="form-control" id="blood_type_id" value="{{ $client->BloodType->id }}">
                            @foreach ($bloodTypes as $bloodType)
                            <option value="{{ $bloodType->id }}" {{ $bloodType->id == $client->bloodType->id ? 'selected' : '' }}>{{ $bloodType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="is_activated">{{ __('messages.isActivated') }}</label>
                        <select name="is_activated" class="form-control" id="is_activated" value="{{ $client->is_activated }}">
                            <option value="1" {{ $client->is_activated == 1 ? 'selected' : '' }}>{{ __('messages.yes') }}</option>
                            <option value="0" {{ $client->is_activated == 0 ? 'selected' : '' }}>{{ __('messages.no') }}</option>
                        </select>
                    </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                  </div>
                </form>

    
            </div>
        </section>
    </div>
</div>
@endsection
