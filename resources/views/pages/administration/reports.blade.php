@extends('layouts.header')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title m-t-0">Selection Criteria</h4>
                        <form id="reportForm" autocomplete="off">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group m-b-0">
                                        <label class="form-label">From <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="date" name="start_date" id="start_date"
                                                   class="date form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group m-b-0">
                                        <label class="form-label">To <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="date" name="end_date" id="end_date" class="date form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-b-0">
                                        <label class="form-label">Supplier</label>
                                        <div class="controls">
                                            <select name="supplier" id="supplier" class="form-control">
                                                <option value="" selected>Select Supplier</option>
                                                <option value="All">All</option>
                                                <option value="Brightsun Travels">Brightsun Travels</option>
                                                <option value="Euro Africa Travels">Euro Africa Travels</option>
                                                <option value="Skylords Travels">Skylords Travels</option>
                                                <option value="Crystal Travels">Crystal Travels</option>
                                                <option value="Citibond Travels">Citibond Travels</option>
                                                <option value="Greaves Travels">Greaves Travels</option>
                                                <option value="Kevin McPhillips">Kevin McPhillips</option>
                                                <option value="Airline">Airline</option>
                                                <option value="Master Fare">Master Fare</option>
                                                <option value="Med View Airline">Med View Airline</option>
                                                <option value="Global Travel">Global Travel</option>
                                                <option value="Cab 101">Cab 101</option>
                                                <option value="Hotel 101">Hotel 101</option>
                                                <option value="E-Visa">E-Visa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-b-0">
                                        <label class="form-label">Report <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <select name="report_name" id="report_name" class="form-control" required>
                                                <option value="" selected>Select Report</option>
                                                <option value="gross_profit_earned">Gross Profit Earned</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group m-b-0">
                                        <label class="form-label">&nbsp;</label>
                                        <div class="controls text-center">
                                            <button type="submit" class="reportFormbtn btn btn-success btn-sm">Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="reportContainer" class="reportdetails"></div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        const loader = '<div class="card card-body"><div class="col-12"><div class="progress progress-sm"><div class="progress-bar progress-bar-indeterminate"></div></div></div></div>';

        $(document).on('submit', '#reportForm', function (e) {
            e.preventDefault();
            var report_name = $("#report_name").val();
            var supplier = $("#supplier").val();
            var sdate = $("#start_date").val();
            var edate = $("#end_date").val();


            $(".reportFormbtn").attr("disabled", "disabled");
            $(".reportFormbtn").html('Searching...');
            // $('.reportdetails').html(loader);

            $.ajax({
                url: "{{route('supplierReport')}}",
                data: {
                    report: report_name,
                    start_date: sdate,
                    end_date: edate,
                    supplier: supplier,
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
                            reportHTML += '<td>' + customer.CreatedAt + '</td>';
                            reportHTML += '<td>' + customer.InvoiceNo+ '</td>';
                            reportHTML += '<td>' +
                                (customer.BookingStatus === "Pending" ? '<a class="text-primary" href="view-tickets/' + customer.InvoiceNo + '">' + customer.InvoiceNo + '</a>'
                                    : (customer.BookingStatus === "Issued" ? '<a class="text-primary" href="issued-tickets/' + customer.InvoiceNo + '">' + customer.InvoiceNo + '</a>'
                                        : '<a class="text-primary" href="cancelled-booking/' + customer.InvoiceNo + '">' + customer.InvoiceNo + '</a>')) + '</td>';
                            reportHTML += '<td>' + customer.SupplierRef + '</td>';
                            reportHTML += '<td>' + customer.CustomerName + '</td>';
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
        });
    </script>
@endsection
