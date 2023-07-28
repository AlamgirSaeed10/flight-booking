@extends('layouts.header')
@section('content')
    <head>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css"
              rel="stylesheet"/>
        <script>$.fn.poshytip = {defaults: null}</script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
        <script
            src="https://cdn.tiny.cloud/1/8ocium3ymud15bb8sswaevn9jxk0jo821fjmyfwj7yml17bw/tinymce/6/tinymce.min.js"></script>
        <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css"
            rel="stylesheet">
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
              rel="stylesheet">
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    </head>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18 text-danger">Pending Booking
                        # {{ $customer_details[0]->InvoiceNo }}</h4>
                    <div class="page-title-right">
                        <a href="{{ url('edit-tickets') }}/{{ $customer_details[0]->InvoiceNo }}"
                           class="btn btn-primary waves-effect waves-light btn-sm">
                            <i class="bx bx-user-plus"></i> update </a>
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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="text-white text-uppercase">Booking Details <span class="text-success"></span>
                        </h5>
                    </div>
                    <div class="card-body bg-success text-white">
                        <div class="row">

                            <div class="col-md-3">
                                <label class="control-label text-left">
                                    <strong>Booking Date</strong>
                                </label>
                                <p>{{ date('d F Y', strtotime($customer_details[0]->BookingDate)) }}</p>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label text-left">
                                    <strong>Services</strong>
                                </label>
                                <br>
                                <div class="form-check-inline">
                                    <input type="checkbox" name="flightcheck" class="servicecheck" id="flightcheck"
                                           checked="">
                                    <label for="flightcheck">Flight</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-cyan">Customer Contacts</h3>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label text-left">
                                    <strong>Full Name</strong>
                                </label>
                                <p>{{ $customer_details[0]->CustomerName }}</p>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label text-left">
                                    <strong>Mobile #</strong>
                                </label>
                                <p>{{ $customer_details[0]->CustomerPhone }}</p>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label text-left">
                                    <strong>Phone #</strong>
                                </label>
                                <p>{{ $customer_details[0]->CustomerPhone }}</p>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label text-left">
                                    <strong>Source</strong>
                                </label>
                                <p> Google </p>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label text-left">
                                    <strong>Email</strong>
                                </label>
                                <p>{{ $customer_details[0]->CustomerEmail }}</p>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label text-left">
                                    <strong>Address</strong>
                                </label>
                                <p>{{ $customer_details[0]->CustomerAddress }}</p>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label text-left">
                                    <strong>City</strong>
                                </label>
                                <p>{{ $customer_details[0]->CustomerCity }}</p>
                            </div>
                            a
                            <div class="col-md-3">
                                <label class="control-label text-left">
                                    <strong>PostCode</strong>
                                </label>
                                <p>{{ $customer_details[0]->CustomerPostCode }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-cyan">Receipt Details</h3>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label text-left">
                                    <strong>Paying By</strong>
                                </label>
                                <p>{{ $recipt_details[0]->PayingBy }}</p>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label text-left">
                                    <strong>Due Date</strong>
                                </label>
                                <p>{{ date('d F Y', strtotime($recipt_details[0]->PaymentDueDate)) }}</p>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label text-left">
                                    <strong>Mode</strong>
                                </label>
                                <p>{{ $recipt_details[0]->ReciptMode }}</p>
                            </div>
                        </div>
                        <span class="card_details"
                              style="display: {{ $recipt_details[0]->ReciptMode === 'Credit Card' || $recipt_details[0]->ReciptMode === 'Debit Card' ? 'block' : 'none' }};">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label text-left">
                                                <strong>Card Holder Name</strong>
                                            </label>
                                            <p>{{ $recipt_details[0]->CardHolderName }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label text-left">
                                                <strong>Card #</strong>
                                            </label>
                                            <p>{{ $recipt_details[0]->CardNo }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label text-left">
                                                <strong>Expiry Date</strong>
                                            </label>
                                            <p>{{ $recipt_details[0]->CardExpiry }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label text-left">
                                                <strong>CVC</strong>
                                            </label>
                                            <p>{{ $recipt_details[0]->CVV }}</p>
                                        </div>
                                    </div>
                                </span>
                    </div>
                </div>
                <ul class="nav nav-tabs mt-3" id="detailtab" data-bs-toggle="tabs">
                    <li class="nav-item flight">
                        <a class="nav-link active show" data-bs-toggle="tab" href="#flight">
                            <strong>Flight Details</strong>
                        </a>
                    </li>
                </ul>
                <div class="tab-content mb-3" id="detailsTabs">
                    <div class="tab-pane card fade rounded-0 active show" id="flight">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label text-left">
                                        <strong>Supplier</strong>
                                    </label>
                                    <p>{{ $customer_details[0]->SupplierAgent }}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label text-left">
                                        <strong>Sup Ref</strong>
                                    </label>
                                    <p>{{ $customer_details[0]->SupplierRef }}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label text-left">
                                        <strong>Sup's Agent</strong>
                                    </label>
                                    <p>{{ $customer_details[0]->SupplierAgent }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="control-label text-left">
                                        <strong>Dept. Arpt.</strong>
                                    </label>

                                    <p>{{ $customer_details[0]->DepartureAirport }}</p>


                                </div>
                                <div class="col-md-2">
                                    <label class="control-label text-left">
                                        <strong>Dest. Arpt.</strong>
                                    </label>
                                    <p>{{ $customer_details[0]->DestinationAirport }}</p>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label text-left">
                                        <strong>Via. Arpt.</strong>
                                    </label>
                                    <p>{{ $customer_details[0]->FlightVia }}</p>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label text-left">
                                        <strong>Flight Type</strong>
                                    </label>
                                    <p>{{ $customer_details[0]->FlightType }}</p>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label text-left">
                                        <strong>Dept Date</strong>
                                    </label>
                                    <p>{{ date('d F Y', strtotime($customer_details[0]->DepartureDate)) }}</p>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label text-left">
                                        <strong>Rtrn. Date</strong>
                                    </label>
                                    <p>{{ date('d F Y', strtotime($customer_details[0]->ReturnDate)) }}</p>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label text-left">
                                        <strong>Flight Class</strong>
                                    </label>
                                    <p>{{ $customer_details[0]->CabinClass }}</p>
                                </div>

                                <div class="col-md-2">
                                    <label class="control-label text-left">
                                        <strong>GDS</strong>
                                    </label>
                                    <p>{{ $customer_details[0]->FlightGDS }}</p>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label text-left">
                                        <strong>Airline</strong>
                                    </label>
                                    <p>{{ $customer_details[0]->Airline }}</p>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label text-left">
                                        <strong>PNR Expiry</strong>
                                    </label>
                                    <p>{{ date('d F Y', strtotime($customer_details[0]->PNRExpiry)) }}</p>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label text-left">
                                        <strong>Fare Expiry</strong>
                                    </label>
                                    <p>{{ date('d F Y', strtotime($customer_details[0]->FareExpiry)) }}</p>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                                    <label class="control-label text-left"> PNR</label>
                                    <textarea class="form-control"
                                              name="PNRDetails">{!! isset($customer_details[0]->PNRDetails) ? $customer_details[0]->PNRDetails : '' !!}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label text-left"> Ticket Details:</label>
                                    <textarea class="form-control"
                                              name="TicketDetail">{!! isset($customer_details[0]->TicketDetail) ? $customer_details[0]->TicketDetail : '' !!}</textarea>
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
                                    <h4 class="card-title text-cyan">Ticket Cost: <strong
                                            class="text-success">{{ number_format($totalAmount, 1) }}</strong>
                                    </h4>
                                </div>
                                <div class="col-md-6 " style="border-right: thin solid #000000;">
                                    <div class="row">
                                        <div class="col-md-12 nopadding">
                                            <h5 class="card-title text-cyan">I) Payable to Supplier: <strong
                                                    class="text-success">{{ number_format($totalAmount, 1) }}</strong>
                                            </h5>
                                        </div>
                                        <div class="col-md-3 nopadding">
                                            <label class="control-label text-left">
                                                <strong>Basic</strong>
                                            </label>
                                            <p>{{ number_format($ticket_cost[0]->BasicAmount, 1) }}</p>
                                        </div>
                                        <div class="col-md-3 nopadding">
                                            <label class="control-label text-left">
                                                <strong>Tax</strong>
                                            </label>
                                            <p>{{ number_format($ticket_cost[0]->TaxAmount, 1) }}</p>
                                        </div>
                                        <div class="col-md-3 nopadding">
                                            <label class="control-label text-left">
                                                <strong>APC</strong>
                                            </label>
                                            <p>{{ number_format($ticket_cost[0]->APCAmount, 1) }}</p>
                                        </div>
                                        <div class="col-md-3 nopadding">
                                            <label class="control-label text-left">
                                                <strong>Misc.</strong>
                                            </label>
                                            <p>{{ number_format($ticket_cost[0]->Misc, 1) }}</p>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $add_total = $ticket_cost[0]->BankFee + $ticket_cost[0]->CardFee + $ticket_cost[0]->APCAmount + $ticket_cost[0]->Misc;
                                @endphp
                                <div class="col-md-6 ">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="card-title text-cyan">II) Additional Expenses: <strong
                                                    class="text-success">{{ number_format($add_total, 1) }}</strong>
                                            </h5>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label text-left">
                                                <strong>Bank</strong>
                                            </label>
                                            <p>{{ number_format($ticket_cost[0]->BankFee, 1) }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label text-left">
                                                <strong>Card</strong>
                                            </label>
                                            <p>{{ number_format($ticket_cost[0]->CardFee, 1) }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label text-left">
                                                <strong>APC</strong>
                                            </label>
                                            <p>{{ number_format($ticket_cost[0]->APCAmount, 1) }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label text-left">
                                                <strong>Misc.</strong>
                                            </label>
                                            <p>{{ number_format($ticket_cost[0]->Misc, 1) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-dark">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h4 class="font-size-18 text-white">Passenger Details</h4>
                                <div class="page-title-right">
                                    <a class="btn btn-info btn-sm edit" data-bs-toggle="modal"
                                       data-bs-target=".bs-example-modal-xl">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit Passanger
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead class="bg-dark text-white ">
                                    <tr>
                                        <th class="text-center">Sr.#</th>
                                        <th class="text-center">Passenger Name</th>
                                        <th class="text-center">Passenger DOB</th>
                                        <th class="text-center">Passenger Type</th>
                                        <th class="text-center">Seat Qty</th>
                                        <th class="text-center">Ticket Price</th>
                                        <th class="text-center">Booking Fee</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $total_amount = 0;
                                    $sub_total = 0;
                                    $total_balance = 0;


                                    foreach ($passanger_details as $key => $value):
                                        $total_amount = (($value->SeatQty * $value->SeatPrice) + $value->BookingFee);
                                        ?>

                                    <tr class="border-dark">
                                        <td class="text-center">{{ ++$key }}</td>
                                        <td class="text-center">{{ $value->PassengerName }}</td>
                                        <td class="text-center">{{ $value->PassengerDOB }}</td>
                                        <td class="text-center">{{ $value->PassengerType }}</td>
                                        <td class="text-center">{{ $value->SeatQty }}</td>
                                        <td class="text-center">{{ $value->SeatPrice }}</td>
                                        <td class="text-center">{{ $value->BookingFee }}</td>
                                        <td class="text-center">{{ number_format((($value->SeatQty * $value->SeatPrice) + $value->BookingFee),2) }}</td>
                                    </tr>
                                        <?php
                                        $sub_total += $total_amount;
                                    endforeach ?>
                                    </tbody>

                                    <tfoot>
                                    <tr class="border-dark">
                                        <td colspan="1" class="text-right"><strong>Total Sale
                                                Price:</strong> <strong
                                                class="text-danger">{{ number_format($sub_total, 2) }}</strong>
                                        </td>
                                        <td colspan="6"></td>
                                        <td colspan="1" class="text-end"><strong>Profit:</strong> <strong
                                                class="text-danger">{{ number_format($sub_total, 2) }}</strong>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
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
                                    <thead class="table-dark text-uppercase bg-dark">
                                    <tr class="agent-tbl">
                                        <th rowspan="2">#</th>
                                        <th rowspan="2">Reciept ID</th>
                                        <th rowspan="2">Paid By</th>
                                        <th rowspan="2">Payment Date</th>
                                        <th rowspan="2">Payment Mode</th>
                                        <th colspan="4">Amount Received</th>
                                    </tr>
                                    <tr class="agent-tbl">
                                        <th colspan="1">Bank</th>
                                        <th colspan="1">Card</th>
                                        <th colspan="1">Cash</th>
                                        <th colspan="1">Other</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($recipt_details as $key => $value)
                                            <?php
                                            $total_balance +=
                                                $value->CashAmount +
                                                $value->CardAmount +
                                                $value->BankAmount +
                                                $value->OtherAmount;
                                            ?>
                                        <tr class="border-dark">
                                            <td class="text-center">{{ ++$key }}</td>
                                            <td class="text-center">{{ $value->ReciptID !== null ? $value->ReciptID :'-' }}</td>
                                            <td class="text-center">{{ $value->PayingBy !== null ? $value->PayingBy :'-' }}</td>
                                            <td class="text-center">{{ $value->PaymentDate !== null ?date('Y-m-d',strtotime($value->PaymentDate)) :'-' }}</td>
                                            <td class="text-center">{{ $value->ReciptMode !== null ? $value->ReciptMode :'-' }}</td>
                                            <td class="text-center">{{ $value->ReciptMode == 'Bank Transfer' ? $value->BankAmount : '-' }}</td>
                                            <td class="text-center">{{ $value->ReciptMode == 'Card' ? $value->CardAmount : '-' }}</td>
                                            <td class="text-center">{{ $value->ReciptMode == 'Cash' ? $value->CashAmount : '-' }}</td>
                                            <td class="text-center">{{ $value->ReciptMode == 'Other' ? $value->OtherAmount : '-' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="border-dark">
                                        <td colspan="9" class="text-end"><strong>Total</strong> <strong
                                                class="text-danger">{{ number_format($total_balance, 2) }}</strong>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="card-title text-cyan">Booking Note:</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea class="form-control"
                                                      name="BookingNote">{!! isset($customer_details[0]->BookingNote) ? $customer_details[0]->BookingNote : '' !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5 class="text-white mb-0">Upload Recipt</h5>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <div class="col-lg-7"><img
                                    src="{{ asset('assets') }}/{{ $recipt_details[0]->ReciptImage }}"
                                    alt="Receipt Image" class="image-responsive" width="400"></div>
                            <div class="col-lg-5">
                                <form method="post" action="{{ route('store_recipt_image') }}"
                                      accept-charset="utf-8" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="AgentID" value="{{ $value->AgentID }}">
                                    <input type="hidden" name="CustomerID" value="{{ $value->CustomerID }}">
                                    <input type="hidden" name="InvoiceNo" value="{{ $value->InvoiceNo }}">
                                    <div class="row">
                                        <div>
                                            <div class="input-group">
                                                <input type="file" name="ReciptImage" class="form-control "
                                                       accept="image/*" value="" required>
                                                <div class="input-group-append">
                                                    <button type="submit"
                                                            class="btn btn-primary rounded-0">Upload
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 p-t-10 p-b-10 text-center">
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#payment_req">Payment &amp; Others Request
                            </button>
                            <button class="btn btn-sm btn-info" type="button" data-bs-toggle="modal"
                                    data-bs-target="#ticket_req">Ticket Order
                            </button>

                            <form method="POST" id="cncl_pending" style="display:none;">
                                @csrf
                                <input type="text" name="CustomerID"
                                       value="{{ $recipt_details[0]->CustomerID }}">
                                <input type="text" name="InvoiceNo"
                                       value="{{ $recipt_details[0]->InvoiceNo }}">
                            </form>
                            <button class="btn btn-sm btn-info CancelPending" id="cancel_pending">Cancel
                                Pending
                            </button>


                            <form id="duplicate" method="post" style="display: none">
                                <input type="hidden" name="duplicate_invoice_id" id="duplicate_invoice_id"
                                       value="{{$customer_details[0]->InvoiceNo}}">


                            </form>
                            <button id="duplicate-ticket" class="btn btn-sm btn-info DuplicateFile">Create Duplicate
                                File
                            </button>
                            <button type="button" class="btn btn-sm btn-info m-r-10" data-bs-toggle="modal"
                                    data-bs-target="#sendeticket">Send E-Ticket
                            </button>

                            <a class="btn btn-sm btn-info" href="{{url('invoice')}}/{{$recipt_details[0]->InvoiceNo}}"
                               id="">Print Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-xl" tabindex="-1" aria-labelledby="myExtraLargeModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Passenger Details </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <!-- Table header -->
                                        <thead class="bg-dark text-white">
                                        <tr>
                                            <th class="text-center">Sr.#</th>
                                            <th class="text-center">Passenger Name</th>
                                            <th class="text-center">Passenger DOB</th>
                                            <th class="text-center">Passenger Type</th>
                                            <th class="text-center">Seat Qty</th>
                                            <th class="text-center">Ticket Price</th>
                                            <th class="text-center">Booking Fee</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $total_amount = 0;
                                        $sub_total = 0;
                                        $total_balance = 0;

                                        foreach ($passanger_details as $key => $value):
                                            $total_amount = (($value->SeatQty * $value->SeatPrice) + $value->BookingFee);
                                            ?>
                                        <tr class="border-dark">
                                            <td class="text-center w-25">{{ ++$key }}</td>
                                            <td class="text-center">
                                                <!-- Add the 'update_record' class and data attributes for x-editable -->
                                                <a href="#" class="update_record"
                                                   data-name="PassengerName"
                                                   data-type="text"
                                                   data-pk="{{ $value->BookingID }}"
                                                   data-title="Enter Passenger Name">{{ $value->PassengerName }}</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="update_record"
                                                   data-name="PassengerDOB"
                                                   data-type="text"
                                                   data-pk="{{ $value->BookingID }}"
                                                   data-title="Select Passenger DOB">{{ $value->PassengerDOB }}</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="update_record"
                                                   data-name="PassengerType"
                                                   data-type="select"
                                                   data-pk="{{ $value->BookingID }}"
                                                   data-title="Select Passenger Type"
                                                   data-source='{"Adult": "Adult", "Young": "Young", "Child": "Child", "Infant": "Infant"}'>{{ $value->PassengerType }}</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="update_record"
                                                   data-name="SeatQty"
                                                   data-type="number"
                                                   data-pk="{{ $value->BookingID }}"
                                                   data-title="Enter Seat Quantity">{{ $value->SeatQty }}</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="update_record"
                                                   data-name="SeatPrice"
                                                   data-type="number"
                                                   data-pk="{{ $value->BookingID }}"
                                                   data-title="Enter Ticket Price">{{ $value->SeatPrice }}</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="update_record"
                                                   data-name="BookingFee"
                                                   data-type="number"
                                                   data-pk="{{ $value->BookingID }}"
                                                   data-title="Enter Booking Fee">{{ $value->BookingFee }}</a>
                                            </td>
                                            <td class="text-center">{{ number_format($total_amount, 2) }}</td>
                                        </tr>
                                            <?php
                                            $sub_total += $total_amount;
                                        endforeach;
                                        ?>

                                        </tbody>

                                        <tfoot>
                                        <tr class="border-dark">
                                            <td colspan="1" class="text-right"><strong>Total Sale Price:</strong>
                                                <strong class="text-danger">{{ number_format($sub_total, 2) }}</strong>
                                            </td>
                                            <td colspan="7"></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="payment_req" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Payment Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="payment_request">
                            @csrf
                            <input type="hidden" class="form-control" value="{{$value->CustomerID}}" name="CustomerID">
                            <input type="hidden" class="form-control" value="{{$value->InvoiceNo}}" name="InvoiceNo">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group m-b-0">
                                        <label class="form-label">Request <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <select name="PaymentType" id="payment_type" required=""
                                                    class="form-control parsley-success" data-parsley-id="77">
                                                <option value="">Select Task Request</option>
                                                <option value="Bank Payment">Bank Payment</option>
                                                <option value="Card Payment">Card Payment</option>
                                                <option value="Cash Payment">Cash Payment</option>
                                                <option value="Other Payment">Other Payment</option>
                                            </select>
                                            <ul class="parsley-errors-list" id="parsley-id-77"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group m-b-0" id="bank_section" style="display: none;">
                                        <label class="form-label">Bank <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <select name="BankName" id="BankName" class="form-control"
                                                    data-parsley-id="79">
                                                <option value="">Select Payment Bank</option>
                                                <option value="ANNA Bank">ANNA Bank</option>
                                                <option value="Card One">Card One</option>
                                                <option value="Lloyd Bank">Lloyd Bank</option>
                                                <option value="Revolut Bank ">Revolut Bank</option>
                                                <option value="Rothak international - Alfalah Bank">Rothak international
                                                    - Alfalah Bank
                                                </option>
                                                <option value="UK Office Cash">UK Office Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Payment Date <span
                                                class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="date" name="PaymentDate" id="PaymentDate"
                                                   class="date form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="number" step="0.01" name="RequestAmount" class="form-control"
                                                   required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Request Note</label>
                                        <div class="controls">
                                            <input name="RequestNote" class="form-control"
                                                   placeholder="Request note...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="paymentreqsubmit" form="payment_request">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).on('change', '#payment_type', function () {
                var type = $(this).val();
                if (type === 'Bank Payment') {
                    $('#bank_section').show(500);
                    $('#payment_bank').attr('required');
                } else {
                    $('#bank_section').hide(500);
                    $('#payment_bank').removeAttr('required');
                    $('#req_payment_date').removeAttr('required');
                }
            });
            $(document).on('submit', '#payment_request', function (e) {
                e.preventDefault();
                var form = $('#payment_request').serialize();

                $("#paymentreqsubmit").attr("disabled", "disabled");
                $("#paymentreqsubmit").html("Processing...");

                $.ajax({
                    url: "{{route('update_recipt_detail')}}",
                    data: form,
                    type: "post",
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                            $('#payment_req').modal('hide');
                        } else {
                            console.log('Else');
                        }
                    },
                    complete: function () {
                        $("#paymentreqsubmit").removeAttr("disabled");
                        $("#paymentreqsubmit").html("Submit");
                        $('#payment_req').modal('hide');
                        var successMessage = document.getElementById("success_msg");
                        successMessage.innerText = "Payment Request has been made...!";
                        successMessage.style.display = "block";
                    }
                });
            });
            document.getElementById("cancel_pending").addEventListener("click", function () {
                var form = $('#cncl_pending').serialize();
                Swal.fire({
                    title: "Cancel Pending Ticket",
                    text: "You won't be able to revert this!",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, Cancel it!",
                    cancelButtonText: "Back"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{route('cancel_ticket')}}",
                            data: form,
                            type: "POST",
                            success: function (response) {
                                Swal.fire("Deleted!", "Your Ticket has been Cancelled.", "success");

                                setTimeout(function () {
                                    window.location.href = "{{ route('pending-tickets') }}";
                                }, 2000); // Delay in milliseconds

                            }
                        });

                    }
                });
            });
            /*<=========================================>
            Code for Rich text editor
            <=========================================>*/
            tinymce.init({
                selector: 'textarea',
                branding: false,
                readonly: true
            });
            $.fn.editable.defaults.mode = 'inline';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
            $('.update_record').editable({
                url: "{{ route('update') }}",
                params: function (params) {
                    // Additional parameters to send with the request
                    params.pk = $(this).data('pk'); // BookingID
                    params.name = $(this).data('name'); // Field name
                    return params;
                },
                success: function (response, newValue) {
                    if (response.status === 'success') {
                        // Handle success (optional)
                        console.log('Field updated successfully.');
                    } else {
                        // Handle error (optional)
                        console.log('Failed to update field.');
                    }
                },
                error: function () {
                    // Handle error (optional)
                    console.log('Error occurred during update.');
                }
            });
            $('.update_record[data-type="text"]').each(function () {
                $(this).editable('option', 'datepicker', {
                    format: 'yyyy-mm-dd',
                    autoclose: true
                });
            });


            document.getElementById("duplicate-ticket").addEventListener("click", function () {
                var duplicate_invoice_id = $('#duplicate').serialize();

                Swal.fire({
                    title: 'Are you sure you want to duplicate Invoice?',
                    showDenyButton: true,
                    showCancelButton: false,
                    icon: 'info',
                    confirmButtonText: 'Create',
                    denyButtonText: `Cancel`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('duplicate-invoice') }}",
                            method: "POST",
                            data: duplicate_invoice_id,
                            dataType: 'json',
                            success: function (data) {
                                Swal.fire({
                                    title: 'Success',
                                    icon: 'success',
                                    html: data.message,
                                    willClose: () => {
                                        location.reload();
                                    }
                                })
                            }
                        })
                    }
                })
            });


        </script>
@endsection
