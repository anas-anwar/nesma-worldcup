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
          <h1>Add player to  {{ $team->name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}" >Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('teams')}}" class="{{ !Route::is('teams.index') ? 'notActive' : '' }}">Teams</a></li>
            <li class="breadcrumb-item active"><a href="{{url('teams/addPlayer/'.$team->id)}}" >Add Player to{{$team->name}}</a></li>
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
        <h3 class="card-title">Add Palyer To Team {{ $team->name }}</h3>
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
            <form method="POST" action="{{route('team.storePlayer',$team->id)}}"   >
             @csrf
                
                <div class="form-group">
                  <label for="exampleInputName">Name</label>
                  <input class="form-control form-control-lg" id="exampleInputName" type="text" name="name" value="{{old('name')}}" required autofocus placeholder="Enter player's name"  >
                </div>
                <div class="form-group">
                  <label for="exampleInputNationality">Nationality</label>
                  <input class="form-control form-control-lg" id="exampleInputNationality" type="text" name="nationality" value="{{old('nationality')}}" required autofocus placeholder="Enter player's nationality" >
                </div>
                <div class="form-group">
                  <label for="exampleInputbirthdate">Birth Date</label>
                  <input class="form-control form-control-lg" id="exampleInputbirthdate" type="date" name="birthdate" value="{{old('birthdate')}}" required autofocus >
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                  <label for="exampleInputbirthdate">height</label>
                  <input class="form-control form-control-lg" id="exampleInputbirthdate" type="number" name="height" min="150"max="220"  value="{{old('height')}}" required autofocus placeholder="Enter player's height" >
                  </div>
                  <div class="col-6">
                  <label for="exampleInputbirthdate">weight</label>
                  <input class="form-control form-control-lg" id="exampleInputbirthdate" type="number" name="weight" min="50" max="120" value="{{old('weight')}}" required autofocus  placeholder="Enter player's weight">
                  </div>
                </div>
                </div>
                <button type="submit" class="btn btn-primary submit">Add Player</button>
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

        
   

   
    
 
</script>


@stop

@stop