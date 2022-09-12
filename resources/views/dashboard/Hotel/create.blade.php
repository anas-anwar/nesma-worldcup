@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Hotel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('hotels')}}" class="{{ !Route::is('hotels.index') ? 'notActive' : '' }}">Hotels</a></li>
            <li class="breadcrumb-item active">Add Hotel</li>
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
        <h3 class="card-title">Add New Hotel</h3>
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
          <form method="POST" action="{{ URL('hotels') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input type="text" value="{{ old('name') }}" class="form-control" id="exampleInputName" name="name" placeholder="Enter Hotel Name" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputDescription">Description</label>
              <textarea class="form-control" id="exampleInputDescription" rows="5" placeholder="Enter Hotel Description" name="description" autofocus>{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPhone">Phone</label>
              <input value="{{ old('phone') }}" type="text" class="form-control" id="exampleInputPhone" name="phone" placeholder="Enter Hotel Phone" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputLatitude">Latitude</label>
              <input value="{{ old('latitude') }}" type="number" class="form-control" id="exampleInputLatitude" name="latitude" placeholder="Enter Hotel Latitude" min="-90" max="90" step="0.00000001" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputLongtude">Longtude</label>
              <input value="{{ old('longtude') }}" type="number" class="form-control" id="exampleInputLongtude" name="longtude" placeholder="Enter Hotel Longtude" min="-180" max="180" step="0.000000001" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputRate">Rate</label>
              <input type="number" class="form-control" id="exampleInputRate" name="rate" min="0" max="5" step="any" value="{{old('rate')}}" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputAddress">Address</label>
              <input value="{{ old('address') }}" type="text" class="form-control" id="exampleInputAddress" name="address" placeholder="Enter Hotel Address" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputHotelUrl">Hotel Url</label>
              <input value="{{ old('hotel_url') }}" type="text" class="form-control" id="exampleInputHotelUrl" name="hotel_url" placeholder="Enter Hotel Url" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary">Add New</button>
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