@extends('dashboard.layouts.app')
@section('title', 'Page Title')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Medical Centers Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{url('dash')}}" class="{{ !Route::is('dashboard') ? 'notActive' : '' }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('medicalcenters')}}" class="{{ !Route::is('medicalcenters.index') ? 'notActive' : '' }}">Medical Centers</a></li>
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
        <div class="alert alert-success">SECCESS</div>
        @else
        <div class="alert alert-danger">FAILD</div>
        @endif
        @endif
        <a href="{{ URL('medicalcenters/create' ) }}" type="button" class="my-3 btn btn-primary">
          <i class="fa fa-plus"></i> Create New Medical Center</a>
        {!! $dataTable->table([
        'id' => 'dataTable',
        'class'=> 'dataTable table table-bordered table-striped table-hover w-100'
        ]) !!}
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
@section('js')
{!! $dataTable->Scripts() !!}
@push('js')
<script>
  $(document).ready(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('body').on('click', '.deletebutton', function() {
      var id = $(this).attr('data-value');
      var url = "{{ url('medicalcenters') }}";
      console.log(id);
      Deletebutton(url, id);
    });
  });
</script>
@endpush

@stop

@stop