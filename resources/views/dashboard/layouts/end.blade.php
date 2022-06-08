<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<!-- Sweet Alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@yield('js')

@stack('js')
<Script type="text/javascript">
    function Deletebutton(url='',id = ''){
        swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "DELETE",
                    url: url+"/"+id,
                    data:  { id: id, _token: '{{csrf_token()}}' },
                    dataType: "json",
                    success: function (response) {
                        swal("Poof! Your data has been deleted!", {
                            icon: "success",
                        });
                        $('#dataTable').dataTable().api().ajax.reload();
                    }
                })
            } else {
                swal("Your Data is safe!");
            }
        })
    };




    function DeleteImage(url='',id = ''){
        swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "DELETE",
                    url: url+"/"+id,
                    data:  { id: id, _token: '{{csrf_token()}}' },
                    dataType: "json",
                    success: function (response) {
                        swal("Poof! Your data has been deleted!", {
                            icon: "success",
                            
                        }).then(function(){ 
                            location.reload();
                                            }
                                );
                    }
                })     
                   
                
            } else {
                swal("Your Data is safe!");
            }
        })
    };




    
</Script>