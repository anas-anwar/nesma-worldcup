@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Service {{ $service->name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('services')}}" class="{{ !Route::is('services.index') ? 'notActive' : '' }}">Services</a></li>
            <li class="breadcrumb-item active">Edit Service {{ $service->name }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edit Service {{ $service->name }}</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="bg-light">
        <div class="card-body m-3">
          <div class="row">
            <div class="col-4">
              <img src="/storage/{{ $service->image }}" class="rounded w-100 p-3">
            </div>
            <div class="col-8">
              <form method="POST" action="{{ URL('services/'. $service->id ) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                  <label for="exampleInputName">Name</label>
                  <input type="text" value="{{ old('name', $service->name) }}" class="form-control" id="exampleInputName" name="name" placeholder="Enter Service Name" required autofocus>
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Image</label>
                  <input accept=".jpeg, .png, .jpg, .gif" class="form-control form-control-lg" id="exampleInputName" type="file" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Edit Service</button>
              </form>
            </div>
          </div>

        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>

@stop