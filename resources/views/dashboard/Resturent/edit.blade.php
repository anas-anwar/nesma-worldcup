@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Resturent {{ $resturent->name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('resturents')}}" class="{{ !Route::is('resturents.index') ? 'notActive' : '' }}">Resturents</a></li>
            <li class="breadcrumb-item active"><a href="{{url('resturent/edit/'.$resturent->id)}}">Edit resturent</a></li>
          </ol>
        </div>
      </div>
      @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <ul style="list-style: none;">
          <li> {{ $error }}</li>
        </ul>
        @endforeach

      </div>
      @endif
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edit Resturent {{ $resturent->name }}</h3>
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
          <form method="POST" action="{{ URL('resturents/'. $resturent->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input type="text" class="form-control" id="exampleInputName" name="name" value="{{old('name',$resturent->name)}}" required autofocus>
            </div>

            <div class="form-group">
              <label for="exampleInputPhone">Phone</label>
              <input type="text" class="form-control" id="exampleInputPhone" name="phone" value="{{old('phone',$resturent->phone)}}" required autofocus>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="exampleInputLatitude">Latitude</label>
                  <input type="number" class="form-control" id="exampleInputLatitude" name="latitude" min="-90" max="90" step="0.00000001" value="{{old('latitude',$resturent->latitude)}}" required autofocus>
                </div>
                <div class="col-6">
                  <label for="exampleInputLongtude">Longtude</label>
                  <input type="number" class="form-control" id="exampleInputLongtude" name="longtude" min="-180" max="180" step="0.00000001" value="{{old('longtude',$resturent->longtude)}}" required autofocus>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputRate">Rate</label>
              <input type="number" class="form-control" id="exampleInputRate" name="rate" min="0" max="5" step="any" value="{{old('rate',$resturent->rate)}}" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputAddress">Address</label>
              <input type="text" class="form-control" id="exampleInputAddress" name="address" value="{{old('address',$resturent->address)}}" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputResturentUrl">Menu Url</label>
              <input type="text" class="form-control" id="exampleInputResturentUrl" name="menu_url" value="{{old('menu_url',$resturent->menu_url)}}" autofocus>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="exampleInputResturentUrl">Open Hour</label>
                  <input type="time" class="form-control" id="exampleInputResturentUrl" name="open" value="{{old('open',$resturent->hour_open)}}" required autofocus>
                </div>
                <div class="col-6">
                  <label for="exampleInputResturentUrl">close Hour</label>
                  <input type="time" class="form-control" id="exampleInputResturentUrl" name="close" value="{{old('close',$resturent->hour_close)}}" required autofocus>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Edit Resturent</button>
          </form>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>

@stop