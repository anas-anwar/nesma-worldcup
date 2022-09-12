@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Resturent</h1>
        </div>




        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('resturents')}}" class="{{ !Route::is('resturents.index') ? 'notActive' : '' }}">Resturents</a></li>
            <li class="breadcrumb-item active"><a href="{{url('resturent/create')}}">Add new resturent</a></li>
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
        <h3 class="card-title">Add New Resturent</h3>

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
          <form method="POST" action="{{ URL('resturents') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Resturent Name" value="{{old('name')}}" required autofocus>
            </div>

            <div class="form-group">
              <label for="exampleInputPhone">Phone</label>
              <input type="text" class="form-control" id="exampleInputPhone" name="phone" placeholder="Enter Resturent Phone" value="{{old('phone')}}" required autofocus>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="exampleInputLatitude">Latitude</label>
                  <input type="number" class="form-control" id="exampleInputLatitude" name="latitude" placeholder="Enter Resturent Latitude" min="-90" max="90" step="0.00000001" value="{{old('latitude')}}" required autofocus>
                </div>
                <div class="col-6">
                  <label for="exampleInputLongtude">Longtude</label>
                  <input type="number" class="form-control" id="exampleInputLongtude" name="longtude" placeholder="Enter Resturent Longtude" min="-180" max="180" step="0.00000001" value="{{old('longtude')}}" required autofocus>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputRate">Rate</label>
              <input type="number" class="form-control" id="exampleInputRate" name="rate" min="0" max="5" step="any" value="{{old('rate')}}" required autofocus>
            </div>

            <div class="form-group">
              <label for="exampleInputAddress">Address</label>
              <input type="text" class="form-control" id="exampleInputAddress" name="address" placeholder="Enter Resturent Address" value="{{old('address')}}" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputResturentUrl">Menu Url</label>
              <input type="text" class="form-control" id="exampleInputResturentUrl" name="menu_url" placeholder="Enter Menu Url" value="{{old('menu_url')}}" autofocus>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="exampleInputResturentUrl">Open Hour</label>
                  <input type="time" class="form-control" id="exampleInputResturentUrl" name="open" placeholder="Enter open hour" value="{{old('open')}}" required autofocus>
                </div>
                <div class="col-6">
                  <label for="exampleInputResturentUrl">close Hour</label>
                  <input type="time" class="form-control" id="exampleInputResturentUrl" name="close" placeholder="Enter close hour" value="{{old('close')}}" required autofocus>
                </div>
              </div>
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