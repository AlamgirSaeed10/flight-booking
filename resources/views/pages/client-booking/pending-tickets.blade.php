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
                  $bank=0;
                  $card=0;
                  $cash=0;
                  $other=0;
                  $i=0;
                  $booking_data = DB::table('customer_details')->where('AgentID',Auth::user()->id)->where('BookingStatus','Pending')->get();
                  $payment_data = DB::table('recipt_details')->where('AgentID','=',Auth::user()->id)->get();

                  @endphp
                  @if(count($booking_data) > 0 && count($payment_data) > 0)

                      @foreach($booking_data as $key =>$value)
                        <tr>
                            <td class="text-center fw-bolder">{{++$i}}</td>
                            <td class="text-center">{{date('d-m-Y',strtotime($value->InvoiceDate))}}</td>
                            <td class="text-center">{{date('d-m-Y',strtotime($value->DepartureDate))}}</td>
                            <td class="text-center"><a href="{{url('view-tickets')}}/{{$value->InvoiceNo}}"><strong>{{$value->InvoiceNo}}</strong></a></td>
                            <td>{{$value->SupplierRef}}</td>
                            <td>{{$value->CustomerName}}</td>
                            <td class="text-center fw-bolder text-muted">{{$payment_data[$key]->BankAmount }}</td>
                            <td class="text-center fw-bolder text-muted">{{$payment_data[$key]->CardAmount }}</td>
                            <td class="text-center fw-bolder text-muted">{{$payment_data[$key]->CashAmount }}</td>
                            <td class="text-center fw-bolder text-muted">{{$payment_data[$key]->OtherAmount}}</td>
                            <td class="text-center fw-bolder text-muted fs-5">
                           <?php
                            $ticket_cost = DB::table('ticket_cost')->where('customerID', '=', $value->CustomerID)->where('AgentID',Auth::user()->id)->first();
                            $amount_recieved = DB::table('recipt_details')->where('customerID', '=', $value->CustomerID)->where('AgentID',Auth::user()->id)->first();

                            $total_cost = $ticket_cost ? $ticket_cost->BasicAmount + $ticket_cost->TaxAmount + $ticket_cost->APCAmount + $ticket_cost->SAFIAmount + $ticket_cost->BankFee + $ticket_cost->CardFee + $ticket_cost->APCPayable + $ticket_cost->Misc : 0;

                            $bank +=$amount_recieved->BankAmount;
                            $card +=$amount_recieved->CardAmount;
                            $cash +=$amount_recieved->CashAmount;
                            $other +=$amount_recieved->OtherAmount;
                            $grand +=$total_cost;
                            echo $total_cost;
                            ?>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr class="text-center">
                        <td colspan="11" class="text-success p-4 font-size-15"> No Data found...!</td>
                    </tr>
                    @endif

            </tbody>
            <tfoot class="bg-light">
    <tr>
        <td colspan="6" class="text-right  fw-bolder text-muted fs-5">Total  :</td>
        <td colspan="1" class="text-center fw-bolder text-muted fs-5">{{$bank}}</td>
        <td colspan="1" class="text-center fw-bolder text-muted fs-5">{{$card}}</td>
        <td colspan="1" class="text-center fw-bolder text-muted fs-5">{{$cash}}</td>
        <td colspan="1" class="text-center fw-bolder text-muted fs-5">{{$other}}</td>
        <td colspan="1" class="text-center fw-bolder text-muted fs-5">{{$grand}}</td>
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
