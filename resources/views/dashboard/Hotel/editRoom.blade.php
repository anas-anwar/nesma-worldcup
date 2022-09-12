@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
@section('js')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Rooms</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('hotels')}}" class="{{ !Route::is('hotels.index') ? 'notActive' : '' }}">Hotels</a></li>
                        <li class="breadcrumb-item active">Edit Room</a></li>
                    </ol>
                </div>
            </div>
            @if(session()->has('status'))
            @if(session('status')==true)
            <script>
                swal(" Room has been added!", {
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
                <h3 class="card-title">Edit Room</h3>
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
                    <form method="POST" action="{{ URL('hotels/updateroom/'. $room->id )}}" id="addImages" enctype="multipart/form-data">
                        @csrf
                        <label for="exampleInputprice">Type of Room</label>
                        <select name="type" class="form-control custom-select">
                            <option value="">Select the hotel room type</option>
                            @foreach (config('constance.Rooms') as $hotel_room)
                            <option value="{{ $hotel_room }}" @if($room->type == $hotel_room) selected @endif>{{ $hotel_room }}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="exampleInputprice">Price</label>
                            <input type="number" value="{{ old('price', $room->price) }}" class="form-control" id="exampleInputprice" name="price" placeholder="Enter the hotel room price" min="1" max="100000" step="0.01" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUrl">Url</label>
                            <input value="{{ old('url', $room->url) }}" type="text" class="form-control" id="exampleInputHotelUrl" name="url" placeholder="Enter Room Url" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary submit">Edit Room</button>
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