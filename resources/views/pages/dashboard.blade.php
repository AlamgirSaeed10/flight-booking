@extends('layouts.header')

@section('content')
	<?php
  use Carbon\Carbon;
		$currentDate = date('Y-m-d');
		$formateddate = date('M-Y', strtotime($currentDate));
	?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 col-lg-12">


  <div class="row">
      <div class="col-xl-3 col-lg-3 col-sm-12 col-md-12">
          <div class="card mini-stats-wid">
              <div class="card-body">
                  <div class="d-flex">
                      <div class="flex-grow-1">
                          <p class="text-muted fw-medium">Pending Orders</p>
                          @php
                          $pending = DB::table('customer_details')->where('AgentID',Auth::user()->id)->where("BookingStatus","Pending")->count();
                          @endphp
                          <h4 class="mb-0">{{$pending <9 ?  '0'.$pending : $pending}}</h4>
                      </div>
                      <div class="flex-shrink-0 align-self-center">
                          <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                              <span class="avatar-title">
                                  <i class="bx bx-copy-alt font-size-24"></i>
                              </span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-sm-12 col-md-12">
          <div class="card mini-stats-wid">
              <div class="card-body">
                  <div class="d-flex">
                      <div class="flex-grow-1">
                          <p class="text-muted fw-medium">Bookings</p>
                          @php
                          $bookings = DB::table('customer_details')->where('AgentID',Auth::user()->id)->count();
                          @endphp

                          <h4 class="mb-0">{{$bookings < 9 ? '0'.$bookings :$bookings}}</h4>
                      </div>
                      <div class="flex-shrink-0 align-self-center ">
                          <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                              <span class="avatar-title rounded-circle bg-primary">
                                  <i class="bx bx-archive-in font-size-24"></i>
                              </span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-sm-12 col-md-12">
          <div class="card mini-stats-wid">
              <div class="card-body">
                  <div class="text-muted">
                @php
                  $upcomingEvents = DB::table('upcoming_events')->get();
                  $color=['danger','success','primary'];
                  @endphp
                  @if(count($upcomingEvents) > 0){

                  @foreach($upcomingEvents as $key => $value){
                  <div class="row">
                    <div class="col-sm-10 col-md-10 col-lg-10">
                    <div class="text-muted d-flex">
                        <p class="mb-0 text-{{$color[$i]}} "> {{$value->EventName}}</p>
                    </div>
                  </div>
                  <div class="col-sm-2 col-md-2 col-lg-2">
                    <div class="text-muted d-flex">
                        <p class="mb-0 font-size-14 text-right font-weight-bolder"> {{rand($i, 100)}}</p>
                    </div>
                </div>
                  </div>
                  @endforeach
                  }@else
                    <div class="row">
                    <div class="col-sm-10 col-md-10 col-lg-10">
                    <div class="text-muted d-flex p-3 justify-content-center">
                        <p class="mb-1 text-danger text-uppercase fw-medium">No Event Found!</p>
                    </div>
                  </div>
                  </div>
                  @endif
              </div>
              </div>
          </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-sm-12 col-md-12">
          <div class="card mini-stats-wid">
              <div class="card-body">
                  <div class="d-flex ">
                      <div class="flex-grow-1 margin1">
                        <p class="text-muted fw-medium" data-original-text="Margin">Margin {{$formateddate}}</p>
                          <?php
                          $currentMonthStart = Carbon::now()->startOfMonth();
                          $totalRevenue = DB::table('customer_booking_details')->where('AgentID',Auth::user()->id)->whereBetween('CreatedAt', [$currentMonthStart, Carbon::now()])
                                ->sum(DB::raw("(SeatPrice * SeatQty) + BookingFee"));
                           ?>
                             <h4 id="margin" class="mb-0" data-original-text="{{number_format($totalRevenue,1)}} £">{{number_format($totalRevenue,1)}} £</h4>
                           </div>
                      <div class="flex-shrink-0 align-self-center">
                          <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                              <span class="avatar-title rounded-circle bg-primary">
                                  <i class="bx bx-pound font-size-24"></i>
                              </span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
  </div>
  <div class="row">
  <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
            <div class="table-responsive">
                <table class="table mb-0 border-white">
                    <thead class="table-dark text-uppercase bg-dark">
                        <tr class="agent-tbl">
                            <th rowspan="2">Rank</th>
                            <th rowspan="2">Agent</th>
                            <th colspan="5">Booking</th>
                            <th colspan="4">Profits</th>
                        </tr>
                          <tr class="agent-tbl">
                            <th colspan="1">Total pending</th>
                            <th colspan="1">today</th>
                            <th colspan="1">New <br><?php echo $formateddate;?></th>
                            <th colspan="1">Issued <br><?php echo $formateddate;?></th>
                            <th colspan="1">Cancelled <br><?php echo $formateddate;?></th>
                            <th colspan="1">Issuance <br><?php echo $formateddate;?></th>
                            <th colspan="1">Cancelled <br><?php echo $formateddate;?></th>
                            <th colspan="1">total <br><?php echo $formateddate;?></th>
                            <th colspan="1">average</th>

                        </tr>
                    </thead>
                   <tbody>
                  @php
                  $thisMonth = DB::table('customer_details')->whereBetween('CreatedAt', [date('Y-m-d',strtotime(now()->startOfMonth())), date('Y-m-d',strtotime(now()->endOfMonth()))])
                      ->where('AgentID', Auth::user()->id)->count();
                  $todayCount = DB::table('customer_details')->whereDate('CreatedAt', today())->where('AgentID',Auth::user()->id)->count();
                  $pending_booking = DB::table('customer_details')->where('AgentID',Auth::user()->id)->where('BookingStatus','Pending')->get();
                  $cancelled_booking = DB::table('customer_details')->where('AgentID',Auth::user()->id)->where('BookingStatus','Cancelled')->get();
                  $issued_booking =  DB::table('customer_details')->where('AgentID',Auth::user()->id)->where('BookingStatus','Issued')->get();
                  $i=0;
                  @endphp
                  @if(count($pending_booking) > 0 || count($cancelled_booking) > 0 || count($issued_booking) > 0)
                <tr class="text-center">
                    <td>{{++$i}}</td>
                    <td>{{Auth::user()->name}}</td>
                    <td><a href="{{ url('/pending-tickets') }}"><strong>{{ isset($pending_booking[0]) && $pending_booking[0]->BookingStatus === "Pending" ? count($pending_booking) : 0 }}</strong></a></td>
                    <td>{{ $todayCount }}</td>
                    <td>{{ $thisMonth }}</td>
                    <td><a href="{{ url('/issued-tickets') }}"><strong>{{ isset($issued_booking[0]) && $issued_booking[0]->BookingStatus === "Issued" ? count($issued_booking) : 0 }}</strong></a></td>
                    <td><a href="{{ url('/cancelled-booking') }}"><strong>{{ isset($cancelled_booking[0]) && $cancelled_booking[0]->BookingStatus === "Cancelled" ? count($cancelled_booking) : 0 }}</strong></a></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>

                @else
                <tr>
                  <td colspan="11" class="text-center text-secondary p-4"><strong>No data found!</strong> </td>
                </tr>
                @endif

            </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
      $("#margin").text("*****");
      $("#margin").click(function() {
        var $this = $(this);
        var originalText = $this.data("original-text");
        var asterisks = "*".repeat(5);
        if ($this.text() === originalText) {
          $this.text(asterisks);
        } else {
          $this.text(originalText);
        }
      });
    });
</script>
@endsection
