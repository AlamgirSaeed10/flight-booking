@extends('layouts.header')
@section('content')

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Agent Booking List</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-4">
                <div class="card bg-primary bg-soft">
                    <div>
                        <div class="row">

                            <div class="col-3 mt-2 p-4">
                                <div class="flex-shrink-0 me-3">
                                    <img src="{{asset('assets/images/users/'.$users[0]->image)}}" alt=""
                                         class="avatar-md rounded-circle img-thumbnail">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="text-primary p-4 text-primary">
                                    <h5 class="text-primary">Agent Detail !</h5>
                                    <span>{{$users[0]->name}}</span> <br>
                                    <span>{{$users[0]->email}}</span><br>
                                    <span>{{$users[0]->Role}} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs me-3">
                                        <span
                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                            <i class="bx bx-copy-alt"></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">Total Orders</h5>
                                </div>
                                <div class="text-muted mt-4">
                                    <h4>{{count($cd_total)}} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs me-3">
                                        <span
                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                            <i class="bx bx-archive-in"></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">Revenue</h5>
                                </div>
                                <div class="text-muted mt-4">
                                    <h4> £ {{number_format($rd_total[0]->rd_total,2)}} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-purchase-tag-alt"></i>
                                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">Avg. Booking <br><small>Per/Month</small></h5>
                                </div>
                                <div class="text-muted mt-4">
                                    <h4>£ {{number_format($rd_total[0]->rd_total / 30,2)}} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">Cust. ID</th>
                                    <th scope="col">Cust. Name</th>
                                    <th scope="col">Cust. Email</th>
                                    <th scope="col">Cust. Phone</th>
                                    <th scope="col">Cust. City</th>
                                    <th scope="col">Airline</th>
                                    <th scope="col">Booking Status</th>
                                    <th scope="col">Dep. Airport</th>
                                    <th scope="col">Dep. Date</th>
                                    <th scope="col">Dest. Airport</th>
                                    <th scope="col">Return Date</th>
                                    <th scope="col">Booking Date</th>

                                </tr>
                                </thead>
                                <tbody>


                                @foreach ($customer_details as $key => $value )
                                    <tr>
                                        <td>{{$value->CustomerID}}</td>
                                        <td>{{$value->CustomerName}}</td>
                                        <td>{{$value->CustomerEmail}}</td>
                                        <td>{{$value->CustomerPhone}}</td>
                                        <td>{{$value->CustomerCity}}</td>
                                        <td>{{$value->Airline}}</td>
                                        <td><span class="p-1 fw-bold badge badge-soft-{{$value->BookingStatus === "Pending" ? 'warning' : ($value->BookingStatus === "Cancelled" ? "danger" : "success")}}
                                         font-size-11 m-1">{{$value->BookingStatus}} </span></td>
                                        <td>{{$value->DepartureAirport}}</td>
                                        <td>{{ date('d F Y', strtotime($value->DepartureDate)) }}</td>
                                        <td>{{$value->DestinationAirport}}</td>
                                        <td>{{ date('d F Y', strtotime($value->ReturnDate)) }}</td>
                                        <td>{{ date('d F Y', strtotime($value->BookingDate)) }}</td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
