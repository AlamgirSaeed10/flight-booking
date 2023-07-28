@extends('layouts.header')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-top border-primary ">
                        <h5 class="">Duplicate Tickets Detail</h5>
                    </div>
                    <div class="card-body">
                        <table class="table align-middle table-nowrap table-hover">
                            <thead class="table-light">
                            <tr>
                                <td>Customer ID</td>
                                <td>Booking ID</td>
                                <td>Customer Name</td>
                                <td>Customer Email</td>
                                <td>Customer Phone</td>
                                <td>Customer City</td>
                                <td>Departure Airport</td>
                                <td>Departure Date</td>
                                <td>Destination Airport</td>
                                <td>Booking Date</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($pdf ?? '' as $value)
                                <tr>
                                    <td>{{$value->CustomerID}}</td>
                                    <td>{{$value->BookingID}}</td>
                                    <td>{{$value->CustomerName}}</td>
                                    <td>{{$value->CustomerEmail}}</td>
                                    <td>{{$value->CustomerPhone}}</td>
                                    <td>{{$value->CustomerCity}}</td>
                                    <td>{{$value->DepartureAirport}}</td>
                                    <td>{{$value->DepartureDate}}</td>
                                    <td>{{$value->DestinationAirport}}</td>
                                    <td>{{$value->BookingDate}}</td>
                                    <td>
                                        <a href="#" class="px-2 text-white btn btn-danger delete-btn"
                                           data-id="{{$value->InvoiceNo}}"> <i class="bx bx-trash"></i> </a>
                                        @csrf

                                        <a href="{{route('generate-pdf',$value->InvoiceNo)}}" class="px-2 text-white btn btn-success"> <i
                                                class="bx bx-download"></i> </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>

        $(document).ready(function () {

            $('.delete-btn').on('click', function (e) {
                e.preventDefault();
                const invoiceNo = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure you want to delete duplicate Invoice?',
                    showDenyButton: true,
                    showCancelButton: false,
                    icon: 'error',
                    confirmButtonText: 'Delete',
                    denyButtonText: `Cancel`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{url('delete_duplicate')}}/" + invoiceNo,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function (data) {
                                Swal.fire({
                                    title: 'Success',
                                    icon: 'success',
                                    html: data.message,
                                    willClose: () => {
                                        location.reload();
                                    }
                                })
                            },
                            error: function (error) {
                                console.error('Error:', error);
                            }
                        });
                    }
                });
            });
        });

    </script>

@endsection
