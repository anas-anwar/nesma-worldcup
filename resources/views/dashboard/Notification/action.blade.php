<div class="row justify-content-center">
    <a href="{{ URL('notifications/'.$data->id ) }}" type="button" class="mx-1 btn btn-success">
        <i class="fa fa-eye"></i></a>
    <a href="{{ URL('notifications/'.$data->id.'/delete' ) }}" type="button" class="mx-1 btn btn-info">
        <i class="fa fa-edit"></i></a>
    <a href="javascript:void(0)" type="button" class="btn btn-danger deletebutton" data-value="{{$data->id}}">
        <i class="fa fa-trash"></i></a>
</div>