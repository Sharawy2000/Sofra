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
                <h1>Articles</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('articles.index') }}"><i class="fas fa-arrow-left"></i> Back</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Articles</li>
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
                  <h3 class="card-title">Update an Article</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form action="{{ route('articles.update',$article->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="title" class="form-control" id="exampleInputEmail1" value="{{ $article->title }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <textarea type="password" name="desc" class="form-control" id="exampleInputPassword1" cols="30">{{ $article->desc }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Category</label>
                      <select name="category_id" class="form-control" id="category_id" value="{{ $article->category->id }}">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $article->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="img">Image</label><br>
                        <img src="{{ asset($article->img) }}" alt="" width="200" height="150">
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name="img" class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text">Upload</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
