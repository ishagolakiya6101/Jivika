@extends('back_layout')
@section('title')
<title>Bookings | {{$site_data['site_name']}}</title>
@endsection
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-between">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Bookings</h5>
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
            <div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">Booking Details</h3>
                                <!-- <p class="text-muted">Add new card to complete payment</p> -->
                            </div>
                            <div class="col-12 d-flex">
                                <p><h5>Customer Name: </h5> <span id="customerName"></span></p>
                            </div>
                            <div class="col-12 d-flex">
                                <p><h5>Service:</h5> <span id="service"></span></p>
                            </div>
                            <div class="col-12 d-flex">
                                <p><h5>Package: </h5> <span id="package"></span></p>
                            </div>
                            <div class="col-12 d-flex">
                                <p><h5>Price: </h5> <span id="price"></span></p>
                            </div>
                            <div class="col-12 d-flex">
                                <p><h5>Order Id: </h5> <span id="orderId"></span></p>
                            </div>
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
    function bookingDetails(id) {
        var url = "{{route('bookingDetails')}}";
        $.ajax({

            type: "POST",

            url: url,

            data: {
                "id": id,
                "_token": "{{ csrf_token() }}"
            },

            success: function(result) {
                console.log(result);
                $('#orderModal').modal('show');
                var customerName = result.order.user.first_name + ' ' + result.order.user.last_name;
                var service = result.package.service.name;
                var package = result.package.name;
                $("#customerName").html(customerName);
                $("#service").html(service);
                $("#package").html(package);
                $("#price").html(result.price);
                $("#orderId").html(result.order.order_id);
            }
        });

    }
</script>
@endsection