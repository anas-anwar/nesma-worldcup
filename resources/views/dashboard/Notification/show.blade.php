@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Show Notification {{ $notification->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('notifications')}}" class="{{ !Route::is('notifications.index') ? 'notActive' : '' }}">Notifications</a></li>
                        <li class="breadcrumb-item active">Notification {{ $notifications->name }}</li>
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
                <h3 class="card-title">Notification {{ $notification->name }}</h3>
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
                        <label for="exampleInputType">Type</label>
                        <input type="text" class="form-control" id="exampleInputType" value="{{ $notification->type }}" placeholder="Enter Notification Type" disabled>
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
                        <label for="exampleInputData">Data</label>
                        <input type="text" class="form-control" id="exampleInputData" value="{{ $notification->data }}" placeholder="Enter Notification Data" disabled>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputReadAt">Read At</label>
                        <input type="text" class="form-control" id="exampleInputReadAt" value="{{ $notification->read_at }}" placeholder="Enter Notification Read At" disabled>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.card-body -->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
</div>

@stop