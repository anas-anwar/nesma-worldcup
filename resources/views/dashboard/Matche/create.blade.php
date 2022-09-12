@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Match</h1>
        </div>




        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('matches')}}" class="{{ !Route::is('matches.index') ? 'notActive' : '' }}">Matches</a></li>
            <li class="breadcrumb-item active"><a href="{{url('matches/create')}}">Create Match</a></li>
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
        <h3 class="card-title">Add New Match</h3>

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
          <form method="POST" action="{{ URL('matches') }}">
            @csrf


            <div class="form-group">
              <label for="exampleInputMatchDate">Date Time</label>
              <input type="datetime-local"   placeholder="dd-mm-yyyy" 
        min="1980-01-01" max="2040-12-31"  class="form-control" id="exampleInputMatchDate" name="date_time" placeholder="Enter Match's Date" value="{{old('date_time')}}" required autofocus>
            </div>
          

            <div class="form-group">
              <label for="exampleInputStadium">Stadium</label>
              <select name="stadium_id" id="" class="form-control" autofocus>
                <option value="" style="opacity: .9;"> Select stadium</option>
                @foreach($stadiums as $stadium)
                <option value="{{$stadium->id}}" @if(old('stadium_id')==$stadium->id) selected @endif>{{$stadium->name}}</option>
                @endforeach
              </select>
            </div>


            <label>Select Round</label>
            @foreach($rounds as $round)
            <div class="form-check">
              <input class="form-check-input" type="radio" value="{{$round->id}}" id="defaultCheck{{$round->id}}" name="round_id" @if(old('round_id')==$round->id) checked @endif >
              <label class="form-check-label" for="defaultCheck1">
                {{$round->name}}
              </label>
            </div>
            @endforeach

            <div class="form-group">
              <label for="exampleInputstadium">Local Team</label>
              <select name="localteam_id" id="" class="form-control" autofocus>
                <option value="" style="opacity: .9;"> Select local team</option>
                @foreach($teams as $team)
                <option value="{{$team->id}}" @if(old('localteam_id')==$team->id) selected @endif>{{$team->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="exampleInputvisitorTeam">Visitor Team</label>
              <select name="visitorteam_id" id="" class="form-control" autofocus>
                <option value="" style="opacity: .9;"> Select visitor team</option>
                @foreach($teams as $team)
                <option value="{{$team->id}}" @if(old('visitorteam_id')==$team->id) selected @endif>{{$team->name}}</option>
                @endforeach
              </select>
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