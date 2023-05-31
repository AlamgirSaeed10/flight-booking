@extends('layouts.header')
@section('content')
<script src="https://cdn.tiny.cloud/1/8ocium3ymud15bb8sswaevn9jxk0jo821fjmyfwj7yml17bw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
            <h5>Booking Details</h5>
          </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif
           <form name="add_name" id="add_name" action="{{ url('addMorePost') }}"  method="post">
          <div class="row">
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="InvoiceNO" class="form-label">Invoice #</label>
              <input type="text" readonly class="form-control" name="InvoiceNo" id="InvoiceNo" value="{{$newInvoice}}">
            </div>
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="InvoiceDate" class="form-label">Invoice Date</label>
              <input type="date" class="form-control" id="InvoiceDate" name="InvoiceDate" placeholder="10 May 2023">
            </div>
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="AgentName" class="form-label">Agent Name</label>
              <input type="text" class="form-control" id="AgentName" name="AgentName" value="{{Auth::user()->name}}" readonly>

            </div>
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="CustomerName" class="form-label">Customer Name</label>
              <input type="text" class="form-control" id="CustomerName" name="CustomerName" placeholder="Enter Customer Name">
            </div>
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="CustomerPhone" class="form-label">Customer Phone</label>
              <input type="text" class="form-control" id="CustomerPhone" name="CustomerPhone" placeholder="Enter Customer Phone">
            </div>
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="CustomerEmail" class="form-label">Customer Email</label>
              <input type="email" class="form-control" id="CustomerEmail" name="CustomerEmail" placeholder="Enter Customer Email">
            </div>
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="CustomerAddress" class="form-label">Customer Address</label>
              <input type="text" class="form-control" id="CustomerAddress" name="CustomerAddress" placeholder="Enter Customer Address">
            </div>
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="CustomerCity" class="form-label">Customer City</label>
              <input type="text" class="form-control" id="CustomerCity" name="CustomerCity" placeholder="Enter Customer City">
            </div>
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="CustomerPostCode" class="form-label">Customer Post Code</label>
              <input type="number" class="form-control" id="CustomerPostCode" name="CustomerPostCode" placeholder="Enter Customer PostCode">
            </div>
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="AirlineConfirmation" class="form-label">Airline Confirmation</label>
              <input type="text" class="form-control" id="AirlineConfirmation" name="AirlineConfirmation" placeholder="Enter Airline Confirmation">
            </div>
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="SupplierAgent" class="form-label">Supplier Agent</label>
              <input type="text" class="form-control" id="SupplierAgent" name="SupplierAgent" placeholder="Enter Supplier Agent">
            </div>
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="SupplierRef" class="form-label">Supplier Ref</label>
              <input type="text" class="form-control" id="SupplierRef" name="SupplierRef" placeholder="Enter Supplier Ref">
            </div>
            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                <label for="FlightSupplier" class="form-label">Flight Supplier <span class="text-danger"> *</span></label>
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

            <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
              <label for="BookingSource" class="form-label">Booking Source</label>
              <select name="BookingSource" class="form-control"  required>
                <option value="">Select Booking Source</option>
                <option value="Newsletter" >Newsletter</option>
                <option value="Google">Google</option>
                <option value="Bing">Bing</option>
                <option value="SMS">SMS</option>
                <option value="Friend">Friend</option>
                <option value="Repeat">Repeat</option>
            </select>
            </div>
          </div>
          <div class="card-header mb-3">
            <h5>Flight Details</h5>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                  <label for="DepartureAirport" class="form-label">Departure Airport</label>
                  <input type="text" class="form-control" id="DepartureAirport" name="DepartureAirport" placeholder="Enter Departure Airport">
                </div>
               <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                  <label for="DestinationAirport" class="form-label">Destination Airport</label>
                  <input type="text" class="form-control" id="DestinationAirport" name="DestinationAirport" placeholder="Enter Destination Airport">
                </div>
                <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                  <label for="DepartureDate" class="form-label">Via</label>
                  <input type="text" class="form-control" id="FlightVia" name="FlightVia" placeholder="Enter Via">
                </div>

                <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                  <label for="FlightType" class="form-label">Flight Type</label>
                  <select class="form-select" name="FlightType" required>
                    <option selected>Select Flight Type</option>
                    <option value="Return">Return</option>
                    <option value="One Way">One Way</option>
                  </select>
                </div>

                  <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                  <label for="DepartureDate" class="form-label">Departure Date</label>
                  <input type="date" class="form-control" id="DepartureDate" name="DepartureDate" placeholder="Enter Departure Date">
                </div>
                <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                  <label for="ReturnDate" class="form-label">Return Date</label>
                  <input type="date" class="form-control" id="ReturnDate" name="ReturnDate" placeholder="Enter Return Date">
                </div>

                <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                  <label for="CabinClass" class="form-label">Cabin Class</label>
                  <select class="form-select" name="CabinClass" required>
                    <option selected>Select Cabin Class</option>
                    <option value="Economy">Economy</option>
                    <option value="Premium Economy">Premium Economy</option>
                    <option value="Business">Business</option>
                    <option value="First Class">First Class</option>
                  </select>
                </div>

                <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                  <label for="FlightType" class="form-label">Airline</label>
                  <input type="text" class="form-control" name="Airline" placeholder="Enter Airline">
                </div>

                <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                  <label for="FlightPNR" class="form-label">Flight PNR</label>
                  <input type="text" class="form-control" name="FlightPNR" placeholder="Enter Flight PNR">
                </div>
                <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                  <label for="FlightType" class="form-label">GDS</label>
                  <select class="form-control" name="FlightGDS">
                    <option selected>Select Booking GDS</option>
                    <option value="World Span">World Span</option>
                    <option value="Galileo">Galileo</option>
                    <option value="Sabre">Sabre</option>
                    <option value="Amadeus">Amadeus</option>
                    <option value="Web">Web</option>
                  </select>
                </div>
                <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                  <label for="FlightType" class="form-label">PNR Expiry</label>
                  <input type="date" class="form-control" name="PNRExpiry" placeholder="Enter PNR Expiry">
                </div>
                <div class="mb-3 col-lg-3 col-sm-12 col-md-12 col-xl-3">
                  <label for="FlightType" class="form-label">Fare Expiry</label>
                  <input type="date" class="form-control" name="FareExpiry" placeholder="Enter Fare Expiry">
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 mb-3">
              <div class="row">
              <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                <label for="Description" class="form-label">PNR Details</label>
                <textarea id="pnrDetails" class="form-control" name="PNRDetails"></textarea>
                </div>
              <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">

                <label for="Description" class="form-label">Booking Note</label>
                <textarea id="bookingNote" class="form-control" name="BookingNote"></textarea>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
            <div class="card-header"><h5>Recipt Details:</h5></div>
              <div class="card-body">
                <div class="row">
                 <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12">
                    <label for="formrow-inputCity" class="form-label">Paying By <b class="text-danger font-size-15">*</b></label>
                    <select class="form-control" name="PayingBy">
                        <option selected>Select Payment Party</option>
                        <option value="Self">Self</option>
                        <option value="Third Party">Third Party</option>
                    </select>
                  </div>
                  <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12">
                    <label for="formrow-inputCity" class="form-label">Recipt Mode <b class="text-danger font-size-15">*</b></label>
                    <select class="form-control" name="ReciptMode" id="card-type">
                      <option selected>Select Recipt Mode</option>
                      <option value="Cash">Cash</option>
                      <option value="Bank Transfer">Bank Transfer</option>
                      <option value="Credit Card">Credit Card</option>
                      <option value="Debit Card">Debit Card</option>
                      <option value="American Express">American Express</option>
                    </select>
                  </div>
                  <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12">
                    <label for="formrow-inputCity" class="form-label">Payment Due Date <b class="text-danger font-size-15">*</b></label>
                    <input type="date" class="form-control" name="PaymentDueDate">
                  </div>
                 </div>
                  <div id="card-info" class="mt-3" style="display:none;">
                    <div class="row">
                      <div class="col-md-3 col-lg-3 col-xl-3 col-sm-12">
                        <label for="formrow-inputCity" class="form-label">Card Holder Name <b class="text-danger font-size-15">*</b></label>
                        <input type="text" class="form-control" name="CardHolderName">
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-3 col-sm-12">
                          <label for="formrow-inputCity" class="form-label">Card No <b class="text-danger font-size-15">*</b></label>
                          <input type="text" class="form-control" name="CardNo">
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-3 col-sm-12">
                          <label for="formrow-inputCity" class="form-label">Expiry Date <b class="text-danger font-size-15">*</b></label>
                        <div class="row">

                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                          <select id="ExpiryMonth" name="ExpiryMonth" class="form-control" required>
                              <option value="" selected>Select Month</option>
                              <option value="01">January</option>
                              <option value="02">February</option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                          <select id="ExpiryYear" name="ExpiryYear" class="form-control">
                              <option value="">Select Year</option>
                              <script>
                                var startYear = new Date().getFullYear();
                                var endYear = startYear + 20;
                                for (var i = startYear; i <= endYear; i++) {
                                  document.write("<option value='" + i + "'>" + i + "</option>");
                                }
                              </script>
                            </select>
                        </div>
                        </div>
                      </div>


                      <div class="col-md-3 col-lg-3 col-xl-3 col-sm-12">
                          <label for="formrow-inputCity" class="form-label">Security No. <b class="text-danger font-size-15">*</b></label>
                          <input type="number" class="form-control" name="CVV">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card-header"><h5>Ticket Cost: <b class="text-success">  0.00</b></h5></div>
              <div class="card-body">
                <div class="row">
                 <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                  <div class="text-left">
                    <p>I) Payable to Supplier:<b class="text-success">  0.00</b></p>
                  </div>
                 <div class="row">

                 <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                    <label for="formrow-inputCity" class="form-label">Basic <b class="text-danger font-size-15">*</b></label>
                    <input type="number" min="0" step="1" class="form-control" name="BasicAmount" placeholder="0.00">
                  </div><div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                    <label for="formrow-inputCity" class="form-label">Tax <b class="text-danger font-size-15">*</b></label>
                    <input type="number" min="0" step="1" class="form-control" name="TaxAmount" placeholder="0.00">
                  </div><div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                    <label for="formrow-inputCity" class="form-label">APC <b class="text-danger font-size-15">*</b></label>
                    <input type="number" min="0" step="1" class="form-control" name="APCAmount" placeholder="0.00">
                  </div><div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                    <label for="formrow-inputCity" class="form-label">SAFI <b class="text-danger font-size-15">*</b></label>
                    <input type="number" min="0" step="1" class="form-control" name="SAFIAmount" placeholder="0.00">
                  </div>
                 </div>
                </div>
                <div class="border-left col-md-6 col-lg-6 col-xl-6 col-sm-12">
                  <div class="text-left">
                    <p>II) Additional Expenses:<b class="text-success">  0.00</b></p>
                  </div>
                 <div class="row">
                 <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                    <label for="formrow-inputCity" class="form-label">Bank Fee <b class="text-danger font-size-15">*</b></label>
                    <input type="number" min="0" step="1" class="form-control" name="BankFee" placeholder="0.00">
                  </div><div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                    <label for="formrow-inputCity" class="form-label">Card Fee <b class="text-danger font-size-15">*</b></label>
                    <input type="number" min="0" step="1" class="form-control" name="CardFee" placeholder="0.00">
                  </div><div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                    <label for="formrow-inputCity" class="form-label">APC Payable <b class="text-danger font-size-15">*</b></label>
                    <input type="number" min="0" step="1" class="form-control" name="APCPayable" placeholder="0.00">
                  </div><div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                    <label for="formrow-inputCity" class="form-label">Misc <b class="text-danger font-size-15">*</b></label>
                    <input type="number" min="0" step="1" class="form-control" name="Misc" placeholder="0.00">
                  </div>
                 </div>
                </div>
              </div>
              </div>
            </div>
          </div>
          <div class="card-header mb-3">
            <p>Sale Price:<b class="text-success">  0.00</b></p>
            <h5>Booking Details</h5>
          </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dynamic_field">
                 <thead>
                   <tr>
                     <th>Name</th>
                     <th>DOB</th>
                     <th>Type</th>
                     <th>Qty</th>
                     <th>Ticket Price</th>
                     <th>Booking Fee</th>
                     <th>Total Cost</th>
                     <th>Action</th>
                   </tr>
                 </thead>
                 <tbody>

                 <tr id="row" class="dynamic-added">
                     <td>
                         <input type="text" class="form-control" name="PassengerName[]" placeholder="Passanger Name"  required>
                     </td>
                     <td>
                         <input type="date" class="form-control" name="PassengerDOB[]" required>
                     </td>
                     <td>
                      <select class="form-control" name="PassengerType[]" required>
                        <option value="Adult">Adult</option>
                        <option value="Young">Young</option>
                        <option value="Child">Child</option>
                        <option value="Infant">Infant</option>
                      </select>
                    </td>
                     <td>
                         <input type="number" class="form-control" name="SeatQty[]" placeholder="Quantity" required >
                     </td>
                     <td>
                         <div class="input-group">
                        <div class="input-group-text"><b>£</b></div>
                        <input type="number" class="form-control" name="SeatPrice[]" placeholder="Seat Price" required >
                      </div>
                     </td>
                     <td>
                      <div class="input-group">
                        <div class="input-group-text"><b>£</b></div>
                        <input type="number" class="form-control" name="BookingFee[]" placeholder="Booking Fee" required >
                      </div>
                     </td>
                     <td>
                       <div class="input-group">
                        <div class="input-group-text"><b>£</b></div>
                        <input type="number" class="form-control" name="TotalAmount" placeholder="0.0" readonly>
                      </div>
                     </td>
                     <td>
                         <button type="button" name="remove" id="" class="btn btn-danger btn_remove">X</button>
                     </td>
                 </tr>
                 </tbody>
              </table>
                <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
                <button type="button" name="add" id="add" class="btn btn-danger">Add New Row</button>

            </div>


         </form>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

      var postURL = "<?php echo url('booking'); ?>";
      var i=1;


      $('#add').click(function(e){
      e.preventDefault();
           i++;
        $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" class="form-control" name="PassengerName[]" placeholder="Passanger Name"  required></td>'+
          '<td><input type="date" class="form-control" name="PassengerDOB[]" required></td>'+
          '<td><select class="form-control" name="PassengerType[]"><option value="Adult">Adult</option><option value="Young">Young</option><option value="Child">Child</option><option value="Infant">Infant</option></select></td>'+
          '<td><input type="number" class="form-control" name="SeatQty[]" placeholder="Quantity" required></td>'+
          '<td><div class="input-group"><div class="input-group-text"><b>£</b></div>'+
          '<input type="number" class="form-control" name="SeatPrice[]" placeholder="Seat Price" required></div></td>'+
          '<td><div class="input-group"><div class="input-group-text"><b>£</b></div><input type="number" class="form-control" name="BookingFee[]" placeholder="Booking Fee" required></div></td><td><div class="input-group"><div class="input-group-text"><b>£</b></div>'+
          '<input type="number" class="form-control" name="TotalAmount" placeholder="0.0" readonly></div></td>'+
          '<td><button type="button" name="remove" id="" class="btn btn-danger btn_remove">X</button></td></tr>');
      });


      $(document).on('click', '.btn_remove', function(e){
      e.preventDefault();
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $('#submit').click(function(e){
      e.preventDefault();
           $.ajax({
                url:postURL,
                method:"POST",
                data:$('#add_name').serialize(),
                type:'json',
                success:function(data)
                {
                  if(data.error){
                    printErrorMsg(data.error);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    }else{
                        i=1;
                        $('.dynamic-added').remove();
                        $('#add_name')[0].reset();

                          Swal.fire({
                            title: 'Success',
                            html: 'Your data has been saved Successfully!',
                            willClose: () => {
                              location.reload();
                            }
                          })
                    }
                }
           });
      });


      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
             setTimeout(function() {
            $('.print-error-msg').fadeOut('slow');
          }, 5000);
         });
      }
    });


    $(document).ready(function() {
  $('#card-type').change(function() {
    if ($(this).val() === 'Credit Card' || $(this).val() === 'Debit Card') {
      $('#card-info').show();
    } else {
      $('#card-info').hide();
    }
  });
});

tinymce.init({
  selector: 'textarea',
  branding: false,
  setup: function (editor) {
    editor.on('change', function () {
      editor.save(); // Save the content before form submission
    });
  }
});


</script>
@endsection
