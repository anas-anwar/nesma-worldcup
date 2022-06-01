@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Show Hotel {{ $hotel->name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{URL('dash')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ URL('hotels') }}"></a>Hotels</li>
            <li class="breadcrumb-item active"> Show Hotel {{ $hotel->name }}</li>
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
        <h3 class="card-title">Show Hotel {{ $hotel->name }}</h3>
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
            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" id="exampleInputName" value="{{ $hotel->name }}" placeholder="Enter Hotel Name" disabled>
            </div>
            <div class="form-group">
                <label for="exampleInputDescription">Description</label>
                <textarea class="form-control" id="exampleInputDescription" rows="5" placeholder="Enter Hotel Description" disabled>{{ $hotel->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputPhone">Phone</label>
                <input type="text" class="form-control" id="exampleInputPhone" value="{{ $hotel->phone }}" name="phone" placeholder="Enter Hotel Phone" disabled>
            </div>
            <div class="form-group">
                <label for="exampleInputLatitude">Latitude</label>
                <input type="number" class="form-control" id="exampleInputLatitude" value="{{ $hotel->latitude }}" name="latitude" placeholder="Enter Hotel Latitude" min="-90" max="90" disabled>
            </div>
            <div class="form-group">
                <label for="exampleInputLongtude">Longtude</label>
                <input type="number" class="form-control" id="exampleInputLongtude" value="{{ $hotel->longtude }}" name="longtude" placeholder="Enter Hotel Longtude" min="-180" max="180" disabled>
            </div>
            <div class="form-group">
                <label for="exampleInputAddress">Address</label>
                <input type="text" class="form-control" id="exampleInputAddress" value="{{ $hotel->address }}" name="address" placeholder="Enter Hotel Address" disabled>
            </div>
            <div class="form-group">
                <label for="exampleInputHotelUrl">Hotel Url</label>
                <input type="text" class="form-control" id="exampleInputHotelUrl" value="{{ $hotel->hotel_url }}" name="hotel_url" placeholder="Enter Hotel Url" disabled>
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