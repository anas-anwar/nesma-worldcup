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
                    <h1>Add Services</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('hotels')}}" class="{{ !Route::is('hotels.index') ? 'notActive' : '' }}">Hotels</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('hotels/service/'.$hotel->id)}}">Add services</a></li>
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
                <h3 class="card-title">Add Services to {{ $hotel->name }}</h3>
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
                    <form method="POST" action="{{ URL('hotels/service/'. $hotel->id )}}">
                        @csrf
                        <h3>Select the hotel Services</h3>
                        <div class="row">
                        @foreach($services as $service)
                       
                            <div class="form-group col-4">
                                <input type="checkbox" name="services[]" value="{{ $service->id }}"@foreach($hotel_services as $h_service) @if($service->id ==$h_service->service->id  ) checked @endif @endforeach
                                />
                                <label>{{ $service->name }} </label>
                                @if($service->image)
                                <img src="/storage/{{$service->image}} " width="30px">
                                @endif
                            </div>
                      

                        @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary submit">Add Services</button>
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