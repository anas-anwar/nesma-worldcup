@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')




<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Show Team {{ $team->name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}" >Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('teams')}}" class="{{ !Route::is('teams.index') ? 'notActive' : '' }}">Teams</a></li>
            <li class="breadcrumb-item active"><a href="{{url('teams/'.$team->id)}}" >Show team</a></li>
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
        <h3 class="card-title">Show Team {{ $team->name }}</h3>
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
                <input type="text" class="form-control" id="exampleInputName" value="{{ $team->name }}" placeholder="Enter Team Name" disabled>
            </div>
            
          

            <div class="form-group">
                <label for="exampleInputPhone">Stadium</label>
                <input type="text" class="form-control" id="exampleInputPhone" value="{{ $team->stadium->name }}"disabled>
            </div>
            <div class="form-group">
              
                <label for="exampleInputLatitude">Shirt Color</label>
                <input type="text" class="form-control" id="exampleInputLatitude" value="{{ $team->shirt_color}}"  disabled>
                
                
              
              </div>
            <div class="form-group">
                <label for="exampleInputAddress" >Group</label>
                <input type="text" class="form-control" id="exampleInputAddress" value="{{ $team->group->name }}" disabled>
            </div>
            <div class="form-group">
                    <label for="exampleInputCapacity" style="display: inherit;">Logo</label>
                    <img src="{{asset('storage/Teams/Logo/'.$team->logo)}}" alt="" height="116" width="220"  >
                </div>
                <div class="form-group">
                    <label for="exampleInputCapacity" style="display: inherit;">Flag</label>
                    <img src="{{asset('storage/Teams/Flags/'.$team->flag_url)}}" alt="" height="116" width="220"  >
                </div>
        </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

  </section>
  <!-- /.content -->


  <section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">{{ $title }}</h3>
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
    <a href="{{ URL('teams/addPlayer',$team->id ) }}" type="button" class="my-3 btn btn-primary" >
      <i class="fa fa-plus"></i> Add player</a>
      <table class="table table-hover ustify-content-center">
  <thead class="thead-light">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Nationality</th>
      <th scope="col">Birth date</th>
      <th scope="col">height</th>
      <th scope="col">weight</th>
      <th scope="col" class="text-center">action</th>
    </tr>
  </thead>
  <tbody>
    
    @forelse($players as $player)
    <tr>
      <th >{{$player->name}}</th>
      <td>{{$player->nationality}}</td>
      <td>{{$player->birthdate}}</td>
      <td>{{$player->height}}</td>
      <td>{{$player->weight}}</td>
      <td>
        <div class="row justify-content-center text-center">
    
    <a href="{{ URL('teams/editPlayer/'.$player->id ) }}" type="button" class="mx-1 btn btn-info text-center" >
    <i class="fa fa-edit"></i></a>
    <a href="javascript:void(0)" type = "button" class="btn btn-danger deletebuttonP " data-value="{{$player->id}}" >
    <i class="fa fa-trash"></i></a>
</div>
</td>
    </tr>

   @empty
   <th colspan="6"  style="text-align: center;">There is no any player</th>
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
$('body').on('click', '.deletebuttonP', function () {
  var id = $(this).attr('data-value');
  var url = "{{ url('teams/deletePlayer/') }}";
  console.log(id);
  DeleteImage(url, id);
});
});
  </script>

@if(session()->has('status'))
  @if(session('status')==true)
  <script>
 swal(" Player has been added!", {
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
