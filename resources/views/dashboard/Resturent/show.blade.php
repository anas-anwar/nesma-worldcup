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
          <h1>Show Resturent {{ $resturent->name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('resturents')}}" class="{{ !Route::is('resturents.index') ? 'notActive' : '' }}">Resturents</a></li>
            <li class="breadcrumb-item active"><a href="{{url('resturents/'.$resturent->id)}}">Show resturent {{ $resturent->name }}</a></li>
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
        <h3 class="card-title">Show Resturent {{ $resturent->name }}</h3>
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
            <input type="text" class="form-control" id="exampleInputName" value="{{ $resturent->name }}" placeholder="Enter Resturent Name" disabled>
          </div>

          <div class="form-group">
            <label for="exampleInputPhone">Phone</label>
            <input type="text" class="form-control" id="exampleInputPhone" value="{{ $resturent->phone }}" name="phone" placeholder="Enter Resturent Phone" disabled>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="exampleInputLatitude">Latitude</label>
                <input type="number" class="form-control" id="exampleInputLatitude" value="{{ $resturent->latitude }}" name="latitude" placeholder="Enter Resturent Latitude" min="-90" max="90" disabled>
              </div>
              <div class="col-6">
                <label for="exampleInputLongtude">Longtude</label>
                <input type="number" class="form-control" id="exampleInputLongtude" value="{{ $resturent->longtude }}" name="longtude" placeholder="Enter Resturent Longtude" min="-180" max="180" disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
                    <label for="exampleInputRate">Rate</label>
                    <input type="number" class="form-control" id="exampleInputRate" name="rate"   value="{{$resturent->rate}}" disabled>
                </div>
          <div class="form-group">
            <label for="exampleInputAddress">Address</label>
            <input type="text" class="form-control" id="exampleInputAddress" value="{{ $resturent->address }}" name="address" placeholder="Enter Resturent Address" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputResturentUrl">Menu Url</label>
            <input type="text" class="form-control" id="exampleInputResturentUrl" name="menu_url" placeholder="Enter Menu Url" value="{{ $resturent->menu_url }}" required disabled>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="exampleInputResturentUrl">Open Hour</label>
                <input type="time" class="form-control" id="exampleInputResturentUrl" name="open" placeholder="Enter open hour" value="{{ $resturent->hour_open }}" required disabled>
              </div>
              <div class="col-6">
                <label for="exampleInputResturentUrl">close Hour</label>
                <input type="time" class="form-control" id="exampleInputResturentUrl" name="close" placeholder="Enter close hour" value="{{ $resturent->hour_close }}" required disabled>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

  </section>
  <!-- /.content -->


  <section class="image">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"> Resturent images</h3>
        <div class="card-tools">
          <a href="{{URL('resturents/addImages/'. $resturent->id)}}" type="button" class="mx-1 btn btn-outline-primary">
            <i class="fa fa-images"></i> Add Images</a>
        </div>
      </div>
      <div class="bg-light">
        <div class="card-body m-3">
          <div class="row ">
            @foreach($images as $image)

            <div class="col-2 m-3 area">
              <img src="{{asset('storage/RestaurantsImages/'.$image->name)}}" alt="" height="116" width="220">
              <a class="remove remove-image" href="javascript:void(0)" type="button" style="display: inline;" data-value="{{$image->id}}">&#215;</a>
            </div>
            @endforeach
          </div>
          {!! $images->links() !!}
        </div>
        @if($images[0]==null)
        <p class="px-4" style="font-size: 20px;
    font-style: italic;text-align:center"> There is no any image</p>
        <!-- /.card-body -->
        @endif
      </div>
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Resturent Services</h3>
            <div class="card-tools">
              <a href="{{ URL('resturents/addServicese/'.$resturent->id)}}" type="button" class="mx-1 btn btn-outline-primary">
                <i class="fa fa-plus"></i> Add Service</a>
            </div>
          </div>
          <div class="bg-light">
            <div class="card-body">
              <div class="row ">
                @foreach($resturent_services as $service)
                <div class="col-2 m-3 area">
                  <!-- <p>{{$service->service_id}}</p> -->
                  <img src="{{asset('storage/'.$service->service->image) }}" alt="" height="116" width="220">
                  <a class="remove deleteService" href="javascript:void(0)" type="button" style="display: inline;" data-value="{{$service->id}}">&#215;</a>

                </div>
                @endforeach
              </div>

              {!! $resturent_services->links() !!}
            </div>
            @if($resturent_services[0]==null)
            <p class="px-4" style="font-size: 20px;
              font-style: italic;text-align:center"> There is no any Service</p>
            <!-- /.card-body -->
            @endif
          </div>

        </div>

        <!-- /.card -->

      </section>
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
      var url = "{{ url('resturents/deleteImage') }}";
      console.log(id);
      DeleteImage(url, id);
    });
  });

  $('body').on('click', '.deleteService', function() {
    var id = $(this).attr('data-value');
    var url = "{{ url('resturents/deleteservice') }}";
    console.log(id);
    DeleteImage(url, id);
  });
</script>
@if(session()->has('status'))
@if(session('status')==true)
<script>
  swal(" data has been added!", {
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