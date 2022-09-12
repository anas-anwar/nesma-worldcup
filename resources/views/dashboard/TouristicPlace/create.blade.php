@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Touristic Place</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('touristicplaces')}}" class="{{ !Route::is('touristicplaces.index') ? 'notActive' : '' }}">Touristic Places</a></li>
            <li class="breadcrumb-item active">Add Touristic Place</li>
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
        <h3 class="card-title">Add New Touristic Place</h3>
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
          <form method="POST" action="{{ URL('touristicplaces') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input type="text" value="{{ old('name') }}" class="form-control" id="exampleInputName" name="name" placeholder="Enter Touristic Place Name" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputCity">City</label>
              <input type="text" value="{{ old('city') }}" class="form-control" id="exampleInputCity" name="city" placeholder="Enter Touristic Place City" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputAddress">Address</label>
              <input value="{{ old('address') }}" type="text" class="form-control" id="exampleInputAddress" name="address" placeholder="Enter Touristic Place Address" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputPhone">Phone</label>
              <input value="{{ old('phone') }}" type="text" class="form-control" id="exampleInputPhone" name="phone" placeholder="Enter Touristic Place Phone" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputLatitude">Latitude</label>
              <input value="{{ old('latitude') }}" type="number" class="form-control" id="exampleInputLatitude" name="latitude" placeholder="Enter Touristic Place Latitude" min="-90" max="90" step="0.00000001" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputLongtude">Longtude</label>
              <input value="{{ old('longtude') }}" type="number" class="form-control" id="exampleInputLongtude" name="longtude" placeholder="Enter Touristic Place Longtude" min="-180" max="180" step="0.000000001" required autofocus>
            </div>

            <div class="form-group">
              <label for="exampleInputMedicalCenterUrl">Touristic Place Url</label>
              <input value="{{ old('url') }}" type="text" class="form-control" id="exampleInputMedicalCenterUrl" name="url" placeholder="Enter Touristic Place Url" required autofocus>
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