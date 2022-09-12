@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Medical Center {{ $medical_center->name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('medicalcenters')}}" class="{{ !Route::is('medicalcenters.index') ? 'notActive' : '' }}">Medical Centers</a></li>
            <li class="breadcrumb-item active">Edit Medical Center {{ $medical_center->name }}</li>
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
        <h3 class="card-title">Edit Medical Center {{ $medical_center->name }}</h3>
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
          <form method="POST" action="{{ URL('medicalcenters/'. $medical_center->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input type="text" class="form-control" id="exampleInputName" name="name" value="{{ old('name', $medical_center->name) }}" placeholder="Enter Medical Center Name" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputCity">City</label>
              <input type="text" value="{{ old('city', $medical_center->city) }}" class="form-control" id="exampleInputCity" name="city" placeholder="Enter Medical Center City" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputAddress">Address</label>
              <input type="text" class="form-control" id="exampleInputAddress" value="{{ old('address',$medical_center->address) }}" name="address" placeholder="Enter Medical Center Address" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputPhone">Phone</label>
              <input type="text" class="form-control" id="exampleInputPhone" value="{{ old('phone',$medical_center->phone) }}" name="phone" placeholder="Enter Medical Center Phone" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputOpenTime">Open Time</label>
              <input value="{{ old('open_time',$medical_center->open_time ) }}" class="form-control" type="time" id="exampleInputOpenTime" name="open_time" min="00:00" max="24:00" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputCloseTime">Close Time</label>
              <input value="{{ old('close_time',$medical_center->close_time) }}" class="form-control" type="time" id="exampleInputCloseTime" name="close_time" min="00:00" max="24:00" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputLatitude">Latitude</label>
              <input type="number" class="form-control" id="exampleInputLatitude" value="{{ old('latitude',$medical_center->latitude) }}" name="latitude" placeholder="Enter Medical Center Latitude" min="-90" max="90" step="0.00000001" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputLongtude">Longtude</label>
              <input type="number" class="form-control" id="exampleInputLongtude" value="{{ old('longtude',$medical_center->longtude) }}" name="longtude" placeholder="Enter Medical Center Longtude" min="-180" max="180" step="0.00000001" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputUrl">Medical Center Url</label>
              <input type="text" class="form-control" id="exampleInputUrl" value="{{ old('url',$medical_center->url) }}" name="url" placeholder="Enter Medical Center Url" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary">Edit Medical Center</button>
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