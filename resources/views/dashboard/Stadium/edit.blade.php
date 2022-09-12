@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Stadium {{ $stadium->name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('stadiums')}}" class="{{ !Route::is('stadiums.index') ? 'notActive' : '' }}">Stadiums</a></li>
            <li class="breadcrumb-item active"><a href="{{url('stadiums/edit/'.$stadium->id)}}">Edit stadium</a></li>
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
        <h3 class="card-title">Edit Stadium {{ $stadium->name }}</h3>
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
          <form method="POST" action="{{ URL('stadiums/'. $stadium->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input type="text" class="form-control" id="exampleInputName" name="name" value="{{old('name',$stadium->name)}}" required autofocus>
            </div>

            <div class="form-group">
              <label for="exampleInputDescription">Description</label>
              <textarea class="form-control" id="exampleInputDescription" rows="5" placeholder="Enter Hotel Description" name="description" autofocus> {{old('description',$stadium->description)}}</textarea>

            </div>

            <div class="form-group">
              <label for="exampleInputPhone">Phone</label>
              <input type="text" class="form-control" id="exampleInputPhone" name="phone" value="{{old('phone',$stadium->phone)}}" required autofocus>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="exampleInputLatitude">Latitude</label>
                  <input type="number" class="form-control" id="exampleInputLatitude" name="latitude" min="-90" max="90" step="0.00000001" value="{{old('latitude',$stadium->latitude)}}" required autofocus>
                </div>
                <div class="col-6">
                  <label for="exampleInputLongtude">Longtude</label>
                  <input type="number" class="form-control" id="exampleInputLongtude" name="longtude" min="-180" max="180" step="0.00000001" value="{{old('longtude',$stadium->longtude)}}" required autofocus>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputAddress">Address</label>
              <input type="text" class="form-control" id="exampleInputAddress" name="address" value="{{old('address',$stadium->address)}}" required autofocus>
            </div>

            <div class="form-group">
              <label for="exampleInputCapacity">Capacity</label>
              <input type="number" class="form-control" id="exampleInputCapacity" name="capacity" placeholder="Enter Stadium Capacity" value="{{old('capacity',$stadium->capacity)}}" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary">Edit Stadium</button>
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