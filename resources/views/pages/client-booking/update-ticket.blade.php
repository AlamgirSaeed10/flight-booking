@extends('layouts.header')
@section('content')
    <script src="https://cdn.tiny.cloud/1/8ocium3ymud15bb8sswaevn9jxk0jo821fjmyfwj7yml17bw/tinymce/6/tinymce.min.js"></script>
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18 text-danger">Update Pending Booking #
                        {{ $customer_details[0]->InvoiceNo }}</h4>
                    <div class="page-title-right">
                        <a href="{{ route('booking-flight') }}" class="btn btn-primary waves-effect waves-light btn-sm">
                            <i class="bx bx-user-plus"></i> Add Booking </a>
                    </div>
                </div>
               @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Display Success Message -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-info">Booking Details <span class="text-success"></span></h5>
                                    <form action="{{route('update-tickets', $customer_details[0]->InvoiceNo)}}" method="POST">
                                        @csrf
                                <div class="row">
                                    <input type="hidden" class="form-control" name="CustomerID"value="{{ $customer_details[0]->CustomerID }}">
                                    <div class="col-md-3">
                                        <label class="control-label text-left">Invoice Date</label>
                                        <input type="date" class="form-control" name="InvoiceDate"
                                        value="{{ date('Y-m-d', strtotime($customer_details[0]->InvoiceDate)) }}">

                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label text-left"> Booking Date</label>
                                        <input type="date" class="form-control" name="BookingDate"
                                        value="{{ date('Y-m-d', strtotime($customer_details[0]->BookingDate)) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label text-left"> Services</label>
                                        <br>
                                        <div class="form-check-inline">
                                            <input type="checkbox" name="flightcheck" class="servicecheck" id="flightcheck"
                                                checked="">
                                            <label for="flightcheck">Flight</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <h5 class="text-info"> Customer Contacts</h5>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                        <label class="control-label text-left"> Full Name</label>
                                        <input type="text" class="form-control" name="CustomerName"
                                            value="{{ $customer_details[0]->CustomerName }}">
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                        <label class="control-label text-left"> Phone #</label>
                                        <input type="text" class="form-control" name="CustomerPhone"
                                            value="{{ $customer_details[0]->CustomerPhone }}">
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                        <label class="control-label text-left"> Source</label>
                                        <select name="BookingSource" class="form-control" required>
                                            <option value="Select Booking Source"
                                                {{ $customer_details[0]->BookingSource === 'Select Booking Source' ? 'selected' : '' }}>
                                                Select Booking Source</option>
                                            <option value="Newsletter"
                                                {{ $customer_details[0]->BookingSource === 'Newsletter' ? 'selected' : '' }}>
                                                Newsletter</option>
                                            <option value="Google"
                                                {{ $customer_details[0]->BookingSource === 'Google' ? 'selected' : '' }}>
                                                Google</option>
                                            <option value="Bing"
                                                {{ $customer_details[0]->BookingSource === 'Bing' ? 'selected' : '' }}>Bing
                                            </option>
                                            <option value="SMS"
                                                {{ $customer_details[0]->BookingSource === 'SMS' ? 'selected' : '' }}>SMS
                                            </option>
                                            <option value="Friend"
                                                {{ $customer_details[0]->BookingSource === 'Friend' ? 'selected' : '' }}>
                                                Friend</option>
                                            <option value="Repeat"
                                                {{ $customer_details[0]->BookingSource === 'Repeat' ? 'selected' : '' }}>
                                                Repeat</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                        <label class="control-label text-left"> Email</label>
                                        <input type="email" class="form-control" name="CustomerEmail"
                                            value="{{ $customer_details[0]->CustomerEmail }}">
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                        <label class="control-label text-left"> Address</label>
                                        <input type="text" class="form-control" name="CustomerAddress"
                                            value="{{ $customer_details[0]->CustomerAddress }}">
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                        <label class="control-label text-left"> City</label>
                                        <input type="text" class="form-control" name="CustomerCity"
                                            value="{{ $customer_details[0]->CustomerCity }}">
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                        <label class="control-label text-left"> PostCode</label>
                                        <input type="text" class="form-control" name="CustomerPostCode"
                                            value="{{ $customer_details[0]->CustomerPostCode }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="text-info"> Receipt Details</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-left"> Paying By</label>
                                        <select class="form-control" name="PayingBy">
                                            <option value="Select Payment Party"
                                                {{ $recipt_details[0]->PayingBy == 'Select Payment Party' ? 'selected' : '' }}>
                                                Select Payment Party</option>
                                            <option value="Self"
                                                {{ $recipt_details[0]->PayingBy == 'Self' ? 'selected' : '' }}>Self
                                            </option>
                                            <option value="Third Party"
                                                {{ $recipt_details[0]->PayingBy == 'Third Party' ? 'selected' : '' }}>Third
                                                Party</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-left"> Due Date</label>
                                        <input type="date" class="form-control" name="PaymentDueDate"
                                            value="{{ date('Y-m-d', strtotime($recipt_details[0]->PaymentDueDate)) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label text-left"> Recipt Mode</label>
                                        <select class="form-control" name="ReciptMode" id="card-type">
                                            <option value="Cash"
                                                {{ $recipt_details[0]->ReciptMode === 'Cash' ? 'selected' : '' }}>Cash
                                            </option>
                                            <option value="Bank Transfer"
                                                {{ $recipt_details[0]->ReciptMode === 'Bank Transfer' ? 'selected' : '' }}>
                                                Bank Transfer</option>
                                            <option value="Credit Card"
                                                {{ $recipt_details[0]->ReciptMode === 'Credit Card' ? 'selected' : '' }}>
                                                Credit Card</option>
                                            <option value="Debit Card"
                                                {{ $recipt_details[0]->ReciptMode === 'Debit Card' ? 'selected' : '' }}>
                                                Debit Card</option>
                                            <option value="American Express"
                                                {{ $recipt_details[0]->ReciptMode === 'American Express' ? 'selected' : '' }}>
                                                American Express</option>
                                        </select>
                                    </div>
                                </div>
                                <span class="card_details card-details-section"
                                    style="display: {{$recipt_details[0]->ReciptMode === 'Credit Card' || $recipt_details[0]->ReciptMode === 'Debit Card' ? 'block' : 'none';}}">
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label class="control-label text-left"> Card Holder Name</label>
                                            <input type="text" class="form-control" name="CardHolderName"
                                                value="{{ $recipt_details[0]->CardHolderName }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label text-left"> Card #</label>
                                            <input type="text" class="form-control" name="CardNo"
                                                value="{{ $recipt_details[0]->CardNo }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label text-left"> Expiry Date</label>
                                            <input type="text" class="form-control" name="CardExpiry"
                                                value="{{ $recipt_details[0]->CardExpiry }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label text-left"> CVC</label>
                                            <input type="text" class="form-control" name="CVV"
                                                value="{{ $recipt_details[0]->CVV }}">
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <ul class="nav nav-tabs mt-3" id="detailtab" data-bs-toggle="tabs">
                            <li class="nav-item flight">
                                <a class="nav-link active show" data-bs-toggle="tab" href="#flight"> Flight Details</a>
                            </li>
                        </ul>
                        <div class="tab-content mb-3" id="detailsTabs">
                            <div class="card" id="flight">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                                            <label for="FlightSupplier" class="form-label">Flight Supplier <span
                                                    class="text-danger"> *</span></label>
                                                <select name="FlightSupplier" class="form-control" required="">
                                                    <option value="">Select Booking Supplier</option>
                                                    <option value="Brightsun Travels" {{$customer_details[0]->FlightSupplier === 'Brightsun Travels'?'selected':'' }}>Brightsun Travels</option>
                                                    <option value="Euro Africa Travels" {{$customer_details[0]->FlightSupplier === 'Euro Africa Travels'?'selected':'' }}>Euro Africa Travels</option>
                                                    <option value="Skylords Travels" {{$customer_details[0]->FlightSupplier === 'Skylords Travels'?'selected':'' }}>Skylords Travels</option>
                                                    <option value="Citibond Travels" {{$customer_details[0]->FlightSupplier === 'Citibond Travels'?'selected':'' }}>Citibond Travels</option>
                                                    <option value="Greaves Travels" {{$customer_details[0]->FlightSupplier === 'Greaves Travels'?'selected':'' }}>Greaves Travels</option>
                                                    <option value="Airline" {{$customer_details[0]->FlightSupplier === 'Airline'?'selected':'' }}>Airline</option>
                                                    <option value="Master Fare" {{$customer_details[0]->FlightSupplier === 'Master Fare'?'selected':'' }}>Master Fare</option>
                                                    <option value="Med View Airline" {{$customer_details[0]->FlightSupplier === 'Med View Airline'?'selected':'' }}>Med View Airline</option>
                                                    <option value="Global Travel" {{$customer_details[0]->FlightSupplier === 'Global Travel'?'selected':'' }}>Global Travel</option>
                                                    <option value="Cab 101" {{$customer_details[0]->FlightSupplier === 'Cab 101'?'selected':'' }}>Cab 101</option>
                                                    <option value="Hotel 101" {{$customer_details[0]->FlightSupplier === 'Hotel 101'?'selected':'' }}>Hotel 101</option>
                                                    <option value="E-Visa" {{$customer_details[0]->FlightSupplier === 'E-Visa'?'selected':'' }}>E-Visa</option>
                                                </select>
                                                </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Sup Ref</label>
                                            <input type="text" class="form-control" name="SupplierRef"
                                                value="{{ $customer_details[0]->SupplierRef }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Sup's Agent</label>
                                            <input type="text" class="form-control" name="SupplierAgent"
                                                value="{{ $customer_details[0]->SupplierAgent }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Airline Conf.</label>
                                            <input type="text" class="form-control" name="AirlineConfirmation"
                                                value="{{ $customer_details[0]->AirlineConfirmation }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Dept. Arpt.</label>
                                            <input type="text" class="form-control" name="DepartureAirport"
                                                value="{{ $customer_details[0]->DepartureAirport }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Dest. Arpt.</label>
                                            <input type="text" class="form-control" name="DestinationAirport"
                                                value="{{ $customer_details[0]->DestinationAirport }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Via. Arpt.</label>
                                            <input type="text" class="form-control" name="FlightVia"
                                                value="{{ $customer_details[0]->FlightVia }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Flight Type</label>
                                           <select class="form-select" name="FlightType" required="">
                                            <option selected="">Select Flight Type</option>
                                            <option value="Return" {{$customer_details[0]->FlightType=== 'Return' ? 'selected':''}}>Return</option>
                                            <option value="One Way" {{$customer_details[0]->FlightType=== 'One Way'?'selected':''}}>One Way</option>
                                          </select>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Dept Date</label>
                                            <input type="date" class="form-control" name="DepartureDate"
                                                value="{{ date('Y-m-d', strtotime($customer_details[0]->DepartureDate)) }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Rtrn. Date</label>
                                            <input type="date" class="form-control" name="ReturnDate"
                                                value="{{ date('Y-m-d', strtotime($customer_details[0]->ReturnDate)) }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Flight Class</label>
                                            <input type="text" class="form-control" name="CabinClass"
                                                value="{{ $customer_details[0]->CabinClass }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> GDS</label>
                                            <input type="text" class="form-control" name="FlightGDS"
                                                value="{{ $customer_details[0]->FlightGDS }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Airline</label>
                                            <input type="text" class="form-control" name="Airline"
                                                value="{{ $customer_details[0]->Airline }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> PNR Expiry</label>
                                            <input type="date" class="form-control" name="PNRExpiry"
                                                value="{{ date('Y-m-d', strtotime($customer_details[0]->PNRExpiry)) }}">
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3">
                                            <label class="control-label text-left"> Fare Expiry</label>
                                            <input type="date" class="form-control" name="FareExpiry"
                                                value="{{ date('Y-m-d', strtotime($customer_details[0]->FareExpiry)) }}">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                                            <label class="control-label text-left"> PNR</label>
                                            <textarea class="form-control" name="PNRDetails">{!! isset($customer_details[0]->PNRDetails) ? $customer_details[0]->PNRDetails : '' !!}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label text-left"> Ticket Details:</label>
                                            <textarea class="form-control" name="TicketDetail">{!! isset($customer_details[0]->TicketDetail) ? $customer_details[0]->TicketDetail : '' !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $totalAmount = $ticket_cost[0]->BasicAmount + $ticket_cost[0]->TaxAmount + $ticket_cost[0]->APCAmount + $ticket_cost[0]->Misc;
                            @endphp
                            <div class="card mb-3">
                                <div id="costSection" class="card-body  booking-bg-green">
                                    <div class="row m-0">
                                        <div class="col-md-12 nopadding">
                                            <h5 class="text-info mb-2"> Ticket Cost </h5>
                                        </div>
                                        <div class="col-md-6" style="border-right: thin solid #000000;">
                                            <div class="row">
                                                <div class="col-md-12 nopadding">
                                                    <h6 class="card-title text-cyan">I) Payable to Supplier: <strong
                                                            class="text-success"><span
                                                                id="payableAmount">{{ number_format($totalAmount, 2) }}</span></strong>
                                                    </h6>
                                                </div>
                                                <div class="col-md-3 nopadding">
                                                    <label class="control-label text-left">
                                                        <strong>Basic</strong>
                                                    </label>
                                                    <input type="number" class="form-control payable-input" name="BasicAmount" value="{{ number_format($ticket_cost[0]->BasicAmount, 2) }}"
                                                        onkeyup="calculatePayableTotal()">
                                                </div>
                                                <div class="col-md-3 nopadding">
                                                    <label class="control-label text-left">
                                                        <strong>Tax</strong>
                                                    </label>
                                                    <input type="number" class="form-control payable-input" name="TaxAmount"value="{{ number_format($ticket_cost[0]->TaxAmount, 2) }}"
                                                        onkeyup="calculatePayableTotal()">
                                                </div>
                                                <div class="col-md-3 nopadding">
                                                    <label class="control-label text-left">
                                                        <strong>APC</strong>
                                                    </label>
                                                    <input type="number" class="form-control payable-input"
                                                        name="ACPAmount"
                                                        value="{{ number_format($ticket_cost[0]->APCAmount, 2) }}"
                                                        onkeyup="calculatePayableTotal()">
                                                </div>
                                                <div class="col-md-3 nopadding">
                                                    <label class="control-label text-left">
                                                        <strong>Misc.</strong>
                                                    </label>
                                                    <input type="number" class="form-control payable-input"
                                                        name="Misc"
                                                        value="{{ number_format($ticket_cost[0]->Misc, 2) }}"
                                                        onkeyup="calculatePayableTotal()">
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $add_total = $ticket_cost[0]->BankFee + $ticket_cost[0]->CardFee + $ticket_cost[0]->APCAmount + $ticket_cost[0]->Misc;
                                        @endphp
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="card-title text-cyan">II) Additional Expenses: <strong
                                                            class="text-success"><span
                                                                id="additionalAmount">{{ number_format($add_total, 2) }}</span></strong>
                                                    </h5>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label text-left">
                                                        <strong>Bank</strong>
                                                    </label>
                                                    <input type="number" class="form-control additional-input"
                                                        name="BankFee"
                                                        value="{{ number_format($ticket_cost[0]->BankFee, 2) }}"
                                                        onkeyup="calculateAdditionalTotal()">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label text-left">
                                                        <strong>Card</strong>
                                                    </label>
                                                    <input type="number" class="form-control additional-input"
                                                        name="CardFee"
                                                        value="{{ number_format($ticket_cost[0]->CardFee, 2) }}"
                                                        onkeyup="calculateAdditionalTotal()">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label text-left">
                                                        <strong>APC</strong>
                                                    </label>
                                                    <input type="number" class="form-control additional-input"
                                                        name="APCAmount"
                                                        value="{{ number_format($ticket_cost[0]->APCAmount, 2) }}"
                                                        onkeyup="calculateAdditionalTotal()">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label text-left">
                                                        <strong>Misc.</strong>
                                                    </label>
                                                    <input type="number" class="form-control additional-input"
                                                        name="Misc"
                                                        value="{{ number_format($ticket_cost[0]->Misc, 2) }}"
                                                        onkeyup="calculateAdditionalTotal()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="card mb-3">
                                <div class="card-header bg-dark">
                                    <h4 class="card-title text-white">Receipts from Customer</h4>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0 border-dark">
                                            <thead class="bg-dark text-white ">
                                                <tr>
                                                    <th class="text-center">Paid By</th>
                                                    <th class="text-center">Receipt Date</th>
                                                    <th class="text-center">Paid By</th>
                                                    <th class="text-center">£ Received</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recipt_details as $key => $value)
                                                <tr class="border-dark">
                                                    <input type="hidden" class="form-control" name="ReciptID[]" value="{{ $value->ReciptID }}">
                                                    <td class="text-center">
                                                        <select class="form-control" name="PayingBy[]">
                                                            <option value="Self"{{ $value->PayingBy === 'Self' ? ' selected' : '' }}>Self</option>
                                                            <option value="Third Party"{{ $value->PayingBy === 'Third Party' ? ' selected' : '' }}>Third Party</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="date" class="form-control" name="PaymentDate[]" value="{{ $value->PaymentDate !== null ?date('Y-m-d',strtotime($value->PaymentDate)) :'' }}">
                                                    </td>
                                                    <td class="text-center">
                                                        <select class="form-control" name="ReciptMode[]">
                                                            <option value="Cash"{{ $value->ReciptMode === 'Cash' ? 'selected' : '' }}>Cash</option>
                                                            <option value="Card"{{ $value->ReciptMode === 'Card' ? ' selected' : '' }}>Card</option>
                                                            <option value="Bank Transfer"{{ $value->ReciptMode === 'Bank Transfer' ? ' selected' : '' }}>Bank Transfer</option>
                                                            <option value="Other"{{ $value->ReciptMode === 'Other' ? ' selected' : '' }}>Other</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control" name="BankAmount[]" value="{{ $value->ReciptMode === 'Cash' ? $value->CashAmount : ( $value->ReciptMode === 'Card' ? $value->CardAmount : ($value->ReciptMode === 'Bank Transfer' ? $value->BankAmount : ($value->ReciptMode === 'Other' ? $value->OtherAmount : '')))}}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="card-title text-cyan">Booking Note:</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="BookingNote">{!! isset($customer_details[0]->BookingNotes) ? $customer_details[0]->BookingNotes : '' !!}</textarea>
                                        </div>
                                        <div class="col-md-12"></div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Update Invoice</button>
                        </div>
                    </div>




                </form>

                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5 class="text-white mb-0">Upload Recipt</h5>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <div class="col-lg-7"><img src="{{asset('assets')}}/{{$recipt_details[0]->ReciptImage}}" alt="Receipt Image" class="image-fluid" width="400"></div>
                            <div class="col-lg-5">
                                <form method="post" action="{{route('update_recipt_image')}}" accept-charset="utf-8" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="AgentID" >
                                    <input type="hidden" name="CustomerID">
                                    <input type="hidden" name="InvoiceNo">
                                    <div class="row">
                                        <div>
                                            <div class="input-group">
                                                <input type="file" name="ReciptImage" class="form-control " accept="image/*" value="" required="">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary rounded-0">Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>














                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
/*<=========================================>
Code for Payment method selection
<=========================================>*/
        $(document).ready(function() {
            $('#card-type').on('change', function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'Credit Card' || selectedValue === 'Debit Card') {
                    $('.card-details-section').show();
                } else {
                    $('.card-details-section').hide();
                }
            });
        });
/*<=========================================>
Code for Rich text edito
<=========================================>*/
        tinymce.init({
            selector: 'textarea',
            branding: false,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save(); // Save the content before form submission
                });
            }
        });
/*<=========================================>
Code for Ticket Cost Calculation
<=========================================>*/
        function calculatePayableTotal() {
            const inputs = document.querySelectorAll('.payable-input');
            let payableTotal = 0;

            inputs.forEach(input => {
                const value = parseFloat(input.value.replace(/,/g, ''));
                if (!isNaN(value)) {
                    payableTotal += value;
                }
            });

            document.getElementById('payableAmount').textContent = payableTotal.toFixed(2);
        }

        function calculateAdditionalTotal() {
            const inputs = document.querySelectorAll('.additional-input');
            let additionalTotal = 0;

            inputs.forEach(input => {
                const value = parseFloat(input.value.replace(/,/g, ''));
                if (!isNaN(value)) {
                    additionalTotal += value;
                }
            });

            document.getElementById('additionalAmount').textContent = additionalTotal.toFixed(2);
        }
/*<=========================================>
Code for Recipt detail update
<=========================================>*/
var selectElements = document.querySelectorAll('select[name="ReciptMode[]"]');
    selectElements.forEach(function(selectElement) {
        selectElement.addEventListener('change', function() {
            var bankAmountInput = this.parentNode.nextElementSibling.querySelector('.bank-amount-input');

            if (this.value === 'Cash') {
                bankAmountInput.value = "{{ $value->CashAmount }}";
            } else if (this.value === 'Card') {
                bankAmountInput.value = "{{ $value->CardAmount }}";
            } else if (this.value === 'Bank Transfer') {
                bankAmountInput.value = "{{ $value->BankAmount }}";
            } else if (this.value === 'Other') {
                bankAmountInput.value = "{{ $value->OtherAmount }}";
            } else {
                bankAmountInput.value = '';
            }
        });
    });

    </script>
@endsection
