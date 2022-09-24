@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Notification</h1> 
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('notifications')}}" class="{{ !Route::is('notifications.index') ? 'notActive' : '' }}">Notifications</a></li>
            <li class="breadcrumb-item active">Create new notification</li>
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
        <h3 class="card-title">Add New Notification</h3>
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
          <form method="POST" action="{{ URL('notifications') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputType">Type</label>
              <input type="text" class="form-control" id="exampleInputType" name="type" placeholder="Enter Notification Type" value="{{old('type')}}" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputNotifiableType">Notifiable Type</label>
              <input type="text" class="form-control" id="exampleInputNotifiableType" name="notifiable_type" placeholder="Enter Notification Notifiable Type" value="{{old('notifiable_type')}}" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputNotifiableId">Notifiable Id</label>
              <input type="text" class="form-control" id="exampleInputNotifiableId" name="notifiable_id" placeholder="Enter Notification Notifiable Id" value="{{old('notifiable_id')}}" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputPhone">Data</label>
              <input type="text" class="form-control" id="exampleInputData" name="data" placeholder="Enter Notification Data" value="{{old('data')}}" required autofocus>
            </div>
            <div class="form-group">
              <label for="exampleInputReadAt">Read At</label>
              <input type="text" class="form-control" id="exampleInputReadAt" name="read_at" placeholder="Enter Notification reat at" value="{{old('read_at')}}" required autofocus>
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