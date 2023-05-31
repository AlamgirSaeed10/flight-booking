@extends('layouts.header')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Pending Tasks</h4>
      </div>
    </div>
  <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Payment & Others</h4>
         <div class="table-responsive">
        <table class="table mb-0 border-white">
            <thead class="table-dark text-uppercase bg-dark">
                <tr class="agent-tbl">
                    <th rowspan="2">#</th>
                    <th rowspan="2">Booking Date</th>
                    <th rowspan="2">Travel Date</th>
                    <th rowspan="2">Ref. No.</th>
                    <th rowspan="2">Sup Ref</th>
                    <th rowspan="2">Customer Name</th>
                    <th colspan="4">Amount Received</th>
                    <th rowspan="2">Amount Due</th>
                </tr>
                <tr class="agent-tbl">
                    <th colspan="1">Bank</th>
                    <th colspan="1">Card</th>
                    <th colspan="1">Cash</th>
                    <th colspan="1">Other</th>
                </tr>
            </thead>
            <tbody>
                  @php
                  $grand=0;
                  $booking_data = DB::table('customer_details')->where('BookingStatus','Cancelled')->get();
                  @endphp

                  @foreach($booking_data as $key =>$value)
                    
                <tr class="text-center">
                    <td>{{$value->CustomerID}}</td>
                    <td>{{date('d-m-Y',strtotime($value->InvoiceDate))}}</td>
                    <td>{{date('d-m-Y',strtotime($value->DepartureDate))}}</td>
                    <td><a href="{{url('view-tickets')}}/{{$value->InvoiceNo}}"><strong>{{$value->InvoiceNo}}</strong></a></td>
                    <td>{{$value->SupplierRef}}</td>
                    <td>{{$value->CustomerName}}</td> 
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                   <?php
                $ticket_cost = DB::table('ticket_cost')->where('customerID', '=', $value->CustomerID)->first();
                $total_cost = $ticket_cost ? $ticket_cost->BasicAmount + $ticket_cost->TaxAmount + $ticket_cost->APCAmount + $ticket_cost->SAFIAmount + $ticket_cost->BankFee + $ticket_cost->CardFee + $ticket_cost->APCPayable + $ticket_cost->Misc : 0;
                $grand +=$total_cost;
                
                echo $total_cost;
                ?>
                    </td>
                </tr> 
                @endforeach
            </tbody>
            <tfoot class="bg-light">
    <tr>
        <td colspan="10" class="text-right font-size-18">Total  :</td>
        <td colspan="1" class="text-center font-size-18">{{$grand}}</td>
    </tr>
</tfoot>
        </table>
      </div>
        </div>
      </div>
    </div>
  <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12"> 
  </div>
    
  </div>
 </div>@endsection
