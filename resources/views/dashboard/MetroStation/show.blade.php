@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<style>
  .area {
    position: relative;
    width: 50%;
    /* background: #333; */
  }

  .area img {
    max-width: 100%;
    height: auto;
  }

  .remove {
    display: none;
    position: absolute;
    top: -10px;
    /* right: -20px; */
    border-radius: 10em;
    padding: 2px 6px 2px;
    text-decoration: none;
    font: 700 21px/20px sans-serif;
    background: #555;
    border: 3px solid #fff;
    color: #fff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
    -webkit-transition: background 0.5s;
    transition: background 0.5s;
  }

  .remove:hover {
    background: #E54E4E;
    padding: 3px 7px 3px;
    top: -11px;
    /* right: -11px; */
  }

  .remove:active {
    background: #E54E4E;
    top: -10px;
    /* right: -11px; */
  }
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Show {{ $metro_station->name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('metrostations')}}" class="{{ !Route::is('metrostations.index') ? 'notActive' : '' }}">Metro Stations</a></li>
            <li class="breadcrumb-item active"><a href="{{url('metrostations/'.$metro_station->id)}}">Show {{ $metro_station->name }}</a></li>
          </ol>
        </div>
      </div>
      @if(session()->has('status'))
      @if(session('status')==true)
      <script>
        swal(" Data has been added!", {
          icon: "success",
          confirmButtonColor: '#0961b5',
        });
      </script>
      @endif
      @endif


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
        <h3 class="card-title">Show Metro Station {{ $metro_station->name }}</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        @foreach($errors->all() as $message)
        <div class="alert alert-danger">{{$message}}</div>
        @endforeach
        @if (session()->has('add_status'))
        @if (session('add_status'))
        <div class="alert alert-success">SECCESS</div>
        @else
        <div class="alert alert-danger">FAILD</div>
        @endif
        @endif
        <div class="bg-light p-3">
          <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" class="form-control" id="exampleInputName" value="{{ $metro_station->name }}" placeholder="Enter Metro Station Name" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputCity">City</label>
            <input type="text" value="{{ $metro_station->city }}" class="form-control" id="exampleInputCity" name="city" placeholder="Enter Metro Station City" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputAddress">Address</label>
            <input type="text" class="form-control" id="exampleInputAddress" value="{{ $metro_station->address }}" name="address" placeholder="Enter Metro Station Address" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputLatitude">Latitude</label>
            <input type="number" class="form-control" id="exampleInputLatitude" value="{{ $metro_station->latitude }}" name="latitude" placeholder="Enter Metro Station Latitude" min="-90" max="90" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputLongtude">Longtude</label>
            <input type="number" class="form-control" id="exampleInputLongtude" value="{{ $metro_station->longtude }}" name="longtude" placeholder="Enter Metro Station Longtude" min="-180" max="180" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputmetro_stationUrl">Metro Station Url</label>
            <input type="text" class="form-control" id="exampleInputmetro_stationUrl" value="{{ $metro_station->url }}" name="url" placeholder="Enter Metro Station Url" disabled>
          </div>
        </div>
        <div class="bg-light p-3 m-x">

        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Metro Station images</h3>
        <div class="card-tools">
          <a href="{{URL('metrostations/addImages/'. $metro_station->id)}}" type="button" class="mx-1 btn btn-outline-primary">
            <i class="fa fa-images"></i> Add Images</a>
        </div>
      </div>
      <div class="bg-light">
        <div class="card-body m-3">
          <div class="row ">
            @foreach($images as $image)
            <div class="col-2 m-3 area">
              <img src="{{asset('storage/MetroStationImages/'.$image->name)}}" alt="" height="116" width="220">
              <a class="remove-image remove" href="javascript:void(0)" type="button" style="display: inline;" data-value="{{$image->id}}">&#215;</a>
            </div>
            @endforeach
          </div>
          @if($images[0]!=null)
          {!! $images->links() !!}
          @endif
        </div>
        @if($images[0]==null)
        <p class="px-4" style="font-size: 20px;
          font-style: italic;text-align:center"> There is no any image</p>
        <!-- /.card-body -->
        @endif
      </div>

      <!-- /.card -->

  </section>


</div>

@section('js')

@push('js')
<script>
  $(document).ready(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('body').on('click', '.remove-image', function() {
      var id = $(this).attr('data-value');
      var url = "{{ url('metrostations/deleteImage') }}";
      console.log(id);
      DeleteImage(url, id);
    });
  });
</script>
@if(session()->has('status'))
@if(session('status')==true)
<script>
  swal(" Data has been added!", {
    icon: "success",
    confirmButtonColor: '#0961b5',
  });
</script>
@endif
@endif


@if ($errors->any())
<div class="alert alert-danger">
  @foreach ($errors->all() as $error)
  <ul style="list-style: none;">
    <li> {{ $error }}</li>
  </ul>
  @endforeach

</div>
@endif

@endpush

@stop
@stop