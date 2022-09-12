@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')




<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Show Match {{ $matche->name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}" >Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('matches')}}" class="{{ !Route::is('matches.index') ? 'notActive' : '' }}">Match</a></li>
            <li class="breadcrumb-item active"><a href="{{url('matches/'.$matche->id)}}" >show Match</a></li>
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
        <h3 class="card-title">Show Matche {{ $matche->name }}</h3>
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
                    <label for="exampleInputMatchDate">Date Time</label>
                    <input type="text" class="form-control" id="exampleInputMatchDate" value="{{$matche->date_time}}"  disabled>
                </div>
               

                   <div class="form-group">
                    <label for="exampleInputStadium">Stadium</label>
                    <input type="text" class="form-control" id="exampleInputMatchEnd"  value="{{$matche->stadium->name}}" disabled>
                </div>

                <div class="form-group">
                    <label for="exampleInputStadium">Round</label>
                    <input type="text" class="form-control" id="exampleInputMatchEnd"  value="{{$matche->round->name}}" disabled>
                </div>

               

                <div class="form-group">
                    <label for="exampleInputStadium">Local Team</label>
                    <input type="text" class="form-control" id="exampleInputMatchEnd"  value="{{$matche->localTeam->name}}" disabled>
                </div>


                
                <div class="form-group">
                    <label for="exampleInputStadium">Visitor Team</label>
                    <input type="text" class="form-control" id="exampleInputMatchEnd"  value="{{$matche->visitorTeam->name}}" disabled>
                </div>
        </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

  </section>
  <!-- /.content -->

  <section class="event">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title"> Matche events</h3>
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
            <div class="alert alert-success">SUCCESS</div>
        @else
            <div class="alert alert-danger">FAILD</div>
        @endif
    @endif
    <a href="{{ URL('matches/addEvent',$matche->id ) }}" type="button" class="my-3 btn btn-primary" >
      <i class="fa fa-plus"></i> Add event</a>
      <table class="table table-hover ustify-content-center">
  <thead class="thead-light">
    <tr>
      <th scope="col">Type Of Event</th>
      <th scope="col">minute</th>
      <th scope="col">Team</th>
      <th scope="col">player</th>
      <th scope="col">player assest</th>
      
      <th scope="col" class="text-center">action</th>
    </tr>
  </thead>
  <tbody>

    @forelse($events as $event)
    <tr>
      <th >{{$event->TypeOfEvents->name}}</th>
      <td>{{$event->minute}}</td>
      <td>{{$event->Teams->name}}</td>
      <td>{{$event->Players->name}}</td>
      <td>@if($event->player2_id!=null){{$event->Playerassesst->name}} @else There is no player assest @endif</td>
      
      <td>
        <div class="row justify-content-center text-center">
    
    <a href="{{ URL('matches/editEvent/'.$event->id ) }}" type="button" class="mx-1 btn btn-info text-center" >
    <i class="fa fa-edit"></i></a>
    <a href="javascript:void(0)" type = "button" class="btn btn-danger remove-event " data-value="{{$event->id}}" >
    <i class="fa fa-trash"></i></a>
</div>
</td>
    </tr>

@empty
   <td colspan="6"  style="text-align: center;">There is no data available</td>
   @endforelse
    </tbody>
</table>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    Footer
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->

</section>


  

</div>

@section('js')

@push('js')
<script>
  $(document).ready(function () {

      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });
      $('body').on('click', '.remove-event', function () {
        var id = $(this).attr('data-value');
        var url = "{{ url('matches/deleteEvent') }}";
        console.log(id);
        DeleteImage(url, id);
      });
    });
</script>
@if(session()->has('status'))
  @if(session('status')==true)
  <script>
 swal(" Events has been added!", {
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
