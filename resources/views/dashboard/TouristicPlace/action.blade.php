<div class="row justify-content-center">
    <a href="{{ URL('touristicplaces/'.$data->id ) }}" type="button" class="mx-1 btn btn-success">
        <i class="fa fa-eye"></i></a>
    <a href="{{ URL('touristicplaces/'.$data->id.'/edit' ) }}" type="button" class="mx-1 btn btn-info">
        <i class="fa fa-edit"></i></a>
    <a href="javascript:void(0)" type="button" class="btn btn-danger deletebutton" data-value="{{$data->id}}">
        <i class="fa fa-trash"></i></a>
</div>
<div class="row justify-content-center my-2">
    <a href="{{ URL('touristicplaces/addImages/'. $data->id ) }}" id="ImageButton" type="button" class="mx-1 btn btn-outline-primary">
        <i class="fa fa-images"></i> Images</a>
</div>


@push('js')
<script>

</script>
@endpush