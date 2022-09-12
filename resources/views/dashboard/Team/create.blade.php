@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Team</h1>
        </div>

       


        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}" >Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('teams')}}" class="{{ !Route::is('teams.index') ? 'notActive' : '' }}">Teams</a></li>
            <li class="breadcrumb-item active"><a href="{{url('teams/create/')}}" >Create new team</a></li>
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
        <h3 class="card-title">Add New Team</h3>
   
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
            <form method="POST" action="{{ URL('teams') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputName">Name</label>
                  <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Team Name" value="{{old('name')}}" required autofocus>
                </div>
               
                <div class="form-group">
                    <label for="exampleInputStaduim">Staduim</label>
                   <select name="stadium_id" id="" class="form-control" autofocus>
                   <option value=""style="opacity: .9;"> Select stadium</option> 
                     @foreach($stadiums as $stadium)
                     <option value="{{$stadium->id}}" @if(old('stadium_id')==$stadium->id) selected @endif>{{$stadium->name}}</option>
                     @endforeach
                   </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputShirtColor">Shirt Color</label>
                    <input type="text" class="form-control" id="exampleInputShirtColor" name="shirt_color" placeholder="Enter Team shirt color"  value="{{old('shirt_color')}}" required autofocus>
                    </div>
                 

                <div class="form-group">
                    <label for="exampleInputGroup">Group</label>
                   <select name="group_id" id="" class="form-control" autofocus>
                   <option value="" style="opacity: .9;"> Select group</option> 
                     @foreach($groups as $group)
                     <option value="{{$group->id}}" @if(old('group_id')==$group->id) selected @endif>{{$group->name}}</option>
                     @endforeach
                   </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputLogo">Logo</label>
                    <input type="file" class="form-control" id="exampleInputLogo" name="logo" placeholder="Enter Team logo"  value="{{old('logo')}}" required autofocus>
                    </div>
                  
                    <div class="form-group">
                    <label for="exampleInputFlag">Flag</label>
                    <input type="file" class="form-control" id="exampleInputLogo" name="flag" placeholder="Enter Team flag"  value="{{old('flag')}}" required autofocus>
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