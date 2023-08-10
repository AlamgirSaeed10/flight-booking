@extends('layouts.header')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Search Bookings</h4>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-dark">
                        <h5 class="text-white mb-0">Search Criteria</h5>
                    </div>
                    <div class="card-body">
                        <form id="searchBookingForm" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                    <label class="form-label">Search By</label>
                                    <select name="searchby" class=" searchby form-control parsley-success" required=""
                                            data-parsley-trigger="focusin focusout" data-parsley-id="9">
                                        <option value="">Select Search</option>
                                        <option value="bkg_date">Booking Date</option>
                                        <option value="flt_departuredate">Traveling Date</option>
                                        <option value="isu_date">Ticket Issuance Date</option>
                                        <option value="cnl_date">Cancellation Date</option>
                                        <option value="bkg_no">Booking Ref No</option>
                                        <option value="p_firstname">Passenger Name</option>
                                        <option value="flt_pnr">PNR</option>
                                        <option value="flt_ticketdetail">Ticket Details</option>
                                        <option value="p_eticket_no">eTicket No</option>
                                        <option value="flt_gds">GDS</option>
                                        <option value="flt_airline">Airline</option>
                                        <option value="bkg_supplier_reference">Supplier Reference</option>
                                        <option value="cst_mobile">Phone/Mobile</option>
                                        <option value="cst_email">Email</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                                    <label for="autoSizingInputGroup">Value</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control searchvalue" name="searchvalue"
                                               id="autoSizingInputGroup"
                                               placeholder="Enter any value">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2 col-xl-2">
                                    <label for="autoSizingInputGroup">Start Date</label>
                                    <div class="input-group">
                                        <input type="date" name="startdate" class="form-control startdate"
                                               id="autoSizingInputGroup" placeholder="Enter any value">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2 col-xl-2">
                                    <label for="autoSizingInputGroup">End Date</label>
                                    <div class="input-group">
                                        <input type="date" name="enddate" class="form-control enddate"
                                               id="autoSizingInputGroup" placeholder="Enter any value">
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-actions text-right">
                                        <button type="submit" class="searchsubmitbtn btn btn-success btn-sm mt-4">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="reportContainer" class="searchresults"></div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        const loader = '<div class="card card-body"><div class="col-12"><div class="progress progress-sm"><div class="progress-bar progress-bar-indeterminate"></div></div></div></div>';
        $(document).on("submit", "#searchBookingForm", function (e) {
            e.preventDefault();
            var searchby = $('.searchby').val();
            var searchvalue = $('.searchvalue').val();
            var startdate = $('.startdate').val();
            var enddate = $('.enddate').val();
            if (searchby === 'bkg_date' || searchby === 'flt_departuredate' || searchby === 'isu_date' || searchby === 'cnl_date') {

                $(".searchsubmitbtn").attr("disabled", "disabled");
                $(".searchsubmitbtn").html('Searching...');
                $('.searchresults').html(loader);
                $.ajax({
                    url: "{{url('search')}}",
                    data: {
                        searchby: searchby,
                        startdate: startdate,
                        enddate: enddate
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    type: "POST",
                    dataType: "json",
                    success: function (response) {

                        var reportHTML = '<div class="card">';
                        reportHTML += `<h5 class="card-header bg-transparent border-bottom text-capitalize">Booking Search Results</h5>`;
                        reportHTML += '<div class="card-body">';
                        reportHTML += '<table class="table table-striped border-white">';
                        reportHTML += '<thead class="bg-dark text-center text-white">';
                        reportHTML += '<tr>';
                        reportHTML += '<th>#</th>';
                        reportHTML += '<th>BOOKING DATE</th>';
                        reportHTML += '<th>TRAVEL DATE</th>';
                        reportHTML += '<th>REF. NO</th>';
                        reportHTML += '<th>SUP. REF</th>';
                        reportHTML += '<th>CUSTOMER NAME</th>';
                        reportHTML += '<th>CANCELLATION DATE</th>';
                        reportHTML += '<th>ISSUANCE DATE</th>';
                        reportHTML += '<th>AGENT</th>';
                        reportHTML += '<th>STATUS</th>';
                        reportHTML += '</tr>';
                        reportHTML += '</thead>';
                        reportHTML += '<tbody>';
                        if (response.data.length === 0) {
                            reportHTML += '<tr><td colspan="10" class="text-center fw-bolder text-success">No data found.</td></tr>';
                        } else {
                            $.each(response.data, function (index, customer) {
                                reportHTML += '<tr>';
                                reportHTML += '<td>' + (++index) + '</td>';
                                reportHTML += '<td>' + customer.BookingDate + '</td>';
                                reportHTML += '<td>' + customer.DepartureDate + '</td>';
                                reportHTML += '<td>' +
                                    (customer.BookingStatus === "Pending" ? '<a class="text-primary" href="view-tickets/' + customer.InvoiceNo + '">' + customer.InvoiceNo + '</a>'
                                        : (customer.BookingStatus === "Issued" ? '<a class="text-primary" href="issued-tickets/' + customer.InvoiceNo + '">' + customer.InvoiceNo + '</a>'
                                            : '<a class="text-primary" href="cancelled-booking/' + customer.InvoiceNo + '">' + customer.InvoiceNo + '</a>')) + '</td>';
                                reportHTML += '<td>' + customer.SupplierRef + '</td>';
                                reportHTML += '<td>' + customer.CustomerName + '</td>';
                                reportHTML += '<td>' + customer.CancellationDate + '</td>';
                                reportHTML += '<td>' + customer.CreatedAt + '</td>';
                                reportHTML += '<td>' + customer.AgentName + '</td>';
                                reportHTML += '<td>' + customer.BookingStatus + '</td>';
                                reportHTML += '</tr>';
                            });
                            reportHTML += '</tbody>';
                            reportHTML += '</table></div></div>';
                        }

                        $('#reportContainer').html(reportHTML);
                    }
                });
                setTimeout(function () {
                    $(".searchsubmitbtn").removeAttr("disabled");
                    $(".searchsubmitbtn").html('Search');
                }, 3000);

            }
            else if (searchby === 'bkg_no'
                || searchby === 'p_firstname'
                || searchby === 'flt_pnr'
                || searchby === 'p_eticket_no'
                || searchby === 'flt_gds'
                || searchby === 'flt_airline'
                || searchby === 'bkg_supplier_reference'
                || searchby === 'cst_mobile'
                || searchby === 'cst_email'
                || searchby === 'flt_ticketdetail'
            ) {
                console.log("searchby", searchby);
                console.log("searchvalue", searchvalue);
                console.log("startdate", startdate);
                console.log("enddate", enddate);

                $(".searchsubmitbtn").attr("disabled", "disabled");
                $(".searchsubmitbtn").html('Searching...');
                $('.searchresults').html(loader);
                $.ajax({
                    url: "{{url('search-value')}}",
                    data: {
                        searchby: searchby,
                        searchvalue: searchvalue,
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    type: "POST",
                    dataType: "json",
                    success: function (response) {

                        var reportHTML = '<div class="card">';
                        reportHTML += `<h5 class="card-header bg-transparent border-bottom text-capitalize">Booking Search Results</h5>`;
                        reportHTML += '<div class="card-body">';
                        reportHTML += '<table class="table table-striped border-white">';
                        reportHTML += '<thead class="bg-dark text-center text-white">';
                        reportHTML += '<tr>';
                        reportHTML += '<th>#</th>';
                        reportHTML += '<th>BOOKING DATE</th>';
                        reportHTML += '<th>TRAVEL DATE</th>';
                        reportHTML += '<th>REF. NO</th>';
                        reportHTML += '<th>SUP. REF</th>';
                        reportHTML += '<th>CUSTOMER NAME</th>';
                        reportHTML += '<th>CANCELLATION DATE</th>';
                        reportHTML += '<th>ISSUANCE DATE</th>';
                        reportHTML += '<th>AGENT</th>';
                        reportHTML += '<th>STATUS</th>';
                        reportHTML += '</tr>';
                        reportHTML += '</thead>';
                        reportHTML += '<tbody>';
                        if (response.data.length === 0) {
                            reportHTML += '<tr><td colspan="10" class="text-center fw-bolder text-success">No data found.</td></tr>';
                        } else {
                            $.each(response.data, function (index, customer) {
                                reportHTML += '<tr>';
                                reportHTML += '<td>' + (++index) + '</td>';
                                reportHTML += '<td>' + customer.BookingDate + '</td>';
                                reportHTML += '<td>' + customer.DepartureDate + '</td>';
                                reportHTML += '<td>' +
                                    (customer.BookingStatus === "Pending" ? '<a class="text-primary" href="view-tickets/' + customer.InvoiceNo + '">' + customer.InvoiceNo + '</a>'
                                        : (customer.BookingStatus === "Issued" ? '<a class="text-primary" href="issued-tickets/' + customer.InvoiceNo + '">' + customer.InvoiceNo + '</a>'
                                            : '<a class="text-primary" href="cancelled-booking/' + customer.InvoiceNo + '">' + customer.InvoiceNo + '</a>')) + '</td>';
                                reportHTML += '<td>' + customer.SupplierRef + '</td>';
                                reportHTML += '<td>' + customer.CustomerName + '</td>';
                                reportHTML += '<td>' + customer.CancellationDate + '</td>';
                                reportHTML += '<td>' + customer.CreatedAt + '</td>';
                                reportHTML += '<td>' + customer.AgentName + '</td>';
                                reportHTML += '<td>' + customer.BookingStatus + '</td>';
                                reportHTML += '</tr>';
                            });
                            reportHTML += '</tbody>';
                            reportHTML += '</table></div></div>';
                        }

                        $('#reportContainer').html(reportHTML);
                    }
                });
                setTimeout(function () {
                    $(".searchsubmitbtn").removeAttr("disabled");
                    $(".searchsubmitbtn").html('Search');
                }, 3000);
            }
        });
    </script>
@endsection
