@extends('layouts.header')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Booking Reports</h4>
      </div>
    </div>
  <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Selection Criteria</h4>
        <form class="row gy-2 gx-3 align-items-center mt-3" id="myForm">
        	<!-- @csrf -->
	        <div class="col-sm-12 col-lg-3 col-xl-3 col-md-12">
	            <label for="autoSizingInput">From <b class="text-danger font-size-14">*</b></label>
	            <input type="date" class="form-control"  name="DateFrom">
	        </div>
	        <div class="col-sm-12 col-lg-3 col-xl-3 col-md-12">
	            <label for="autoSizingInputGroup">To <b class="text-danger font-size-14">*</b></label>
	            <div class="input-group">
	                <input type="date" class="form-control" name="DateTo"  >
	            </div>
	        </div>
	        <div class="col-lg-3 col-sm-12 col-md-12 col-xl-3">
                <label for="FlightSupplier" class="form-label">Flight Supplier <span class="text-danger"> *</span></span></label>
                <select name="FlightSupplier" class="form-control" required="">
                      <option value="">Select Booking Supplier</option>
                      <option value="Brightsun Travels">Brightsun Travels</option>
                      <option value="Euro Africa Travels">Euro Africa Travels</option>
                      <option value="Skylords Travels">Skylords Travels</option>
                      <option value="Citibond Travels">Citibond Travels</option>
                      <option value="Greaves Travels">Greaves Travels</option>
                      <option value="Airline">Airline</option>
                      <option value="Master Fare">Master Fare</option>
                      <option value="Med View Airline">Med View Airline</option>
                      <option value="Global Travel">Global Travel</option>
                      <option value="Cab 101">Cab 101</option>
                      <option value="Hotel 101">Hotel 101</option>
                      <option value="E-Visa">E-Visa</option>
                  </select>
              </div>
	        <div class="col-sm-12 col-lg-3 col-xl-3 col-md-12">
	            <label class="" for="autoSizingSelect">Report <b class="text-danger font-size-14">*</b> </label>
	            <select class="form-select" name="ReportType">
	                <option selected="">Select Report</option>
	                <option value="profit">Gross Profit Earned</option>
	            </select>
	        </div>

	        <div class="col-sm-12 col-lg-3 col-xl-3 col-md-12 mt-4">
	            <button type="submit" class="btn btn-primary w-md">Submit</button>
	        </div>
	    </form>
        </div>
      </div>
    </div>
  </div>
 </div>
<!-- <button id="load-data">Load Data</button> -->

<div class="table-responsive">
        <table class="table mb-0 border-white" id="myTable" style="display:none;">
            <thead class="table-dark text-uppercase bg-dark">
                <tr class="agent-tbl">
                    <th>#</th>
                    <th>SupplierName</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    $('#myForm').submit(function(event) {
      event.preventDefault(); // prevent default form submission
      var formData = $(this).serialize(); // serialize form data
      $.ajax({
        url: '/data',
        data: formData,
        dataType: 'json',
        success: function(data) {
          var table = $('#myTable').find('tbody');
          table.empty();
          $.each(data, function(index, row) {
            var tr = $('<tr>');
            tr.append($('<td>').text(row.SupplierID));
            tr.append($('<td>').text(row.SupplierName));
            tr.append($('<td>').text(row.CreatedAt));
            tr.append($('<td>').text(row.UpdatedAt));
            table.append(tr);
          });
          $('#myTable').show();
        }
      });
    });
  });
</script>

 @endsection
