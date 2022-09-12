@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Stadium</h1>
        </div>




        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('stadiums')}}" class="{{ !Route::is('stadiums.index') ? 'notActive' : '' }}">Stadiums</a></li>
            <li class="breadcrumb-item active"><a href="{{url('stadiums/create/')}}">Create new stadium</a></li>
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
        <h3 class="card-title">Add New Stadium</h3>

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
          <form method="POST" action="{{ URL('stadiums') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Stadium Name" value="{{old('name')}}" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputDescription">Description</label>
              <textarea class="form-control" id="exampleInputDescription" rows="5" placeholder="Enter Hotel Description" name="description" autofocus> {{old('description')}}</textarea>

            </div>
            <div class="form-group">
              <label for="exampleInputPhone">Phone</label>
              <input type="text" class="form-control" id="exampleInputPhone" name="phone" placeholder="Enter Stadium Phone" value="{{old('phone')}}" required autofocus>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="exampleInputLatitude">Latitude</label>
                  <input type="number" class="form-control" id="exampleInputLatitude" name="latitude" placeholder="Enter Stadium Latitude" min="-90" max="90" step="0.00000001" value="{{old('latitude')}}" required autofocus>
                </div>
                <div class="col-6">
                  <label for="exampleInputLongtude">Longtude</label>
                  <input type="number" class="form-control" id="exampleInputLongtude" name="longtude" placeholder="Enter Stadium Longtude" min="-180" max="180" step="0.00000001" value="{{old('longtude')}}" required autofocus>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputAddress">Address</label>
              <input type="text" class="form-control" id="exampleInputAddress" name="address" placeholder="Enter Stadium Address" value="{{old('address')}}" required autofocus>
            </div>

            <div class="form-group">
              <label for="exampleInputCapacity">Capacity</label>
              <input type="number" class="form-control" id="exampleInputCapacity" name="capacity" placeholder="Enter Stadium Capacity" value="{{old('capacity')}}" required autofocus>
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