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
          <form id="search-form">
            @csrf
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
              <label class="form-label">Search By</label>
              <select name="searchby" class="searchby form-control">
                  <option value="">Select Search</option>
                  <option value="Booking Date">Booking Date</option>
                  <option value="Traveling Date">Traveling Date</option>
                  <option value="Ticket Issuance Date">Ticket Issuance Date</option>
                  <option value="Cancellation Date">Cancellation Date </option>
                  <option value="Booking Ref No">Booking Ref No</option>
                  <option value="Passenger SurName">Passenger SurName</option>
                  <option value="Passenger First Name">Passenger First Name</option>
                  <option value="PNR">PNR</option>
                  <option value="Ticket Details">Ticket Details</option>
                  <option value="Ticket No">eTicket No</option>
                  <option value="GDS">GDS</option>
                  <option value="Airline">Airline</option>
                  <option value="Supplier Reference">Supplier Reference</option>
                  <option value="Phone">Phone/Mobile</option>
                  <option value="Email">Email</option>
              </select>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                <label for="autoSizingInputGroup">Value</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Enter any value">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-2 col-xl-2">
                <label for="autoSizingInputGroup">Start Date</label>
                <div class="input-group">
                    <input type="date" name="start_date"class="form-control" id="autoSizingInputGroup" placeholder="Enter any value">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-2 col-xl-2">
                <label for="autoSizingInputGroup">End Date</label>
                <div class="input-group">
                    <input type="date" name="end_date" class="form-control" id="autoSizingInputGroup" placeholder="Enter any value">
                </div>
            </div>
           
              <div class="col-sm-12 col-md-6 col-lg-2 col-xl-2">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="result-container">
    <!-- AJAX response will be inserted here -->
</div>
  </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#search-form').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: "{{ route('search') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                $('#result-container').html(response);

                console.log("data",response);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
});


</script>

@endsection
