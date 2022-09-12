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
          <h1>Add event</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}" >Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('matches')}}" class="{{ !Route::is('matches.index') ? 'notActive' : '' }}">Match</a></li>
         <li class="breadcrumb-item active"><a href="{{url('matches/addEvent/'.$matche->id)}}"> Add Event{{ $matche->name }}</a></li>
          </ol>
        </div>
      </div>
@if(session()->has('status'))
  @if(session('status')==true)
  <script>
 swal(" Images has been added!", {
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
        <h3 class="card-title">Add event to match  --{{ $matche->name }}--</h3>
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
            <form method="POST" action="{{route('matche.storeEvent',$matche->id)}}" id="addImages" enctype="multipart/form-data"  >
             @csrf
                
             <div class="form-group">
                 
                    
                    
             <label for="exampleInputMatchStart">Minute</label>
                    <input type="number" class="form-control" id="exampleInputMatchStart" name="minute" placeholder="Enter Match Start"  value="{{old('minute')}}"required autofocus>
                    </div>


             <label >Type Of Event </label>
                @foreach($type_of_events as $type_of_event)
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="{{$type_of_event->id}}" id="defaultCheck{{$type_of_event->id}}" name="type_of_events_id"  @if(old('type_of_events_id')==$type_of_event->id) checked @endif >
                  <label class="form-check-label" for="defaultCheck1">
                    {{$type_of_event->name}}
                  </label>
                </div>
              @endforeach
              <div class="form-group">
                    <label for="exampleInputstadium"> player</label>
                   <select name="player1_id" id="" class="form-control" autofocus>
                   <option value="" style="opacity: .9;"> Select player</option> 
                     @foreach($player_local as $player)
                     <option value="{{$player->id}}" @if(old('player1_id')==$player->id) selected @endif>{{$player->name}} --local team-- </option>
                     @endforeach
                     @foreach($player_visitor as $player)
                     <option value="{{$player->id}}" @if(old('player1_id')==$player->id) selected @endif>{{$player->name}} --visitor team-- </option>
                     @endforeach
                   </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputstadium"> player asset</label>
                   <select name="player2_id" id="" class="form-control" autofocus>
                   <option value="" style="opacity: .9;"> no any player asset</option> 
                     @foreach($player_local as $player)
                     <option value="{{$player->id}}" @if(old('player2_id')==$player->id) selected @endif>{{$player->name}} --local team-- </option>
                     @endforeach
                     @foreach($player_visitor as $player)
                     <option value="{{$player->id}}" @if(old('player2_id')==$player->id) selected @endif>{{$player->name}} --visitor team-- </option>
                     @endforeach
                   </select>
                </div>

               

                <button type="submit" class="btn btn-primary submit">Add event</button>
            </form>
        </div>
    </div>
  
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

  </section>
  <!-- /.content -->
</div>

<script >
  //   $(document).on('click','.submit', function (e){
  //   e.preventDefoult();
  //   var formData=new FormData($('#addImages')[0]);
  //  $.ajax({
  //                   type: "Post",
  //                   enctype:"multipart/form-data",
  //                   url: "{{route('resturent.storeImages',$matche->id)}}",
  //                   data:  formData,
  //                  processData:false,
  //                  contentType:false,
  //                  cach:false,
                    
  //                   success: function (response) {
  //                     if(response.status==true){
  //                       swal(" Images has been added!", {
  //                           icon: "success",
                          
  //                       });
  //                     }
  //                   },
  //               error: function (response) {
  //                     if(response.status==false){
  //                       swal(" Images hasn't been added!", {
  //                           icon: "fail",
                          
  //                       });
  //                     }
  //                   }  
  //               });
  //   });
  
        
   

   
    
 
</script>


@stop

@stop