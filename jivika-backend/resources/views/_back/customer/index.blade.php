@extends('back_layout')
@section('title')
    <title>Users | {{$site_data['site_name']}}</title>
@endsection
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Users</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-block p-3">
                        {{$dataTable->table()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{{$dataTable->scripts()}}
<script>
    function deleteCustomer(id)
    {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
        
                    type:"POST",
        
                        url:"{{route('customer.destroy')}}",
        
                        data:{"id":id, "_token": "{{ csrf_token() }}" },
        
                        success:function(result)
                        {
                            if(result['success']){
                                toastr.success(result['success'], 'Success');
                                window.LaravelDataTables['user-table'].ajax.reload();
                            }else if(result['error']){
                                toastr.error(result['error'], 'Error')
                            }
                        }
                    });
                
            }
            });
    }
</script>
@endsection 