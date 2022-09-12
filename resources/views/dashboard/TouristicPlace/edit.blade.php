@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Touristic Place {{ $touristic_place->name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('touristicplaces')}}" class="{{ !Route::is('touristicplaces.index') ? 'notActive' : '' }}">Touristic Places</a></li>
            <li class="breadcrumb-item active">Edit Touristic Place {{ $touristic_place->name }}</li>
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
        <h3 class="card-title">Edit Touristic Place {{ $touristic_place->name }}</h3>
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
          <form method="POST" action="{{ URL('touristicplaces/'. $touristic_place->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input type="text" class="form-control" id="exampleInputName" name="name" value="{{ old('name', $touristic_place->name) }}" placeholder="Enter Touristic Place Name" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputCity">City</label>
              <input type="text" value="{{ old('city', $touristic_place->city) }}" class="form-control" id="exampleInputCity" name="city" placeholder="Enter Touristic Place City" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputAddress">Address</label>
              <input type="text" class="form-control" id="exampleInputAddress" value="{{ old('address',$touristic_place->address) }}" name="address" placeholder="Enter Touristic Place Address" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputPhone">Phone</label>
              <input type="text" class="form-control" id="exampleInputPhone" value="{{ old('phone',$touristic_place->phone) }}" name="phone" placeholder="Enter Touristic Place Phone" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputLatitude">Latitude</label>
              <input type="number" class="form-control" id="exampleInputLatitude" value="{{ old('latitude',$touristic_place->latitude) }}" name="latitude" placeholder="Enter Touristic Place Latitude" min="-90" max="90" step="0.00000001" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputLongtude">Longtude</label>
              <input type="number" class="form-control" id="exampleInputLongtude" value="{{ old('longtude',$touristic_place->longtude) }}" name="longtude" placeholder="Enter Touristic Place Longtude" min="-180" max="180" step="0.00000001" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputUrl">Touristic Place Url</label>
              <input type="text" class="form-control" id="exampleInputUrl" value="{{ old('url',$touristic_place->url) }}" name="url" placeholder="Enter Touristic Place Url" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary">Edit Touristic Place</button>
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