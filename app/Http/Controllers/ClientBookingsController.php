<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Schema,Auth;
use Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ClientBookingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    function booking_flight(){
        $lastInvoiceNo = DB::table('customer_details')->orderBy('InvoiceNo', 'DESC')->first();
            if ($lastInvoiceNo) {
              $lastInvoice = intval(substr($lastInvoiceNo->InvoiceNo, 4)) + 1;
              $newInvoice = 'ZIS-' . str_pad($lastInvoice, 4, '0', STR_PAD_LEFT);
            } else {
              $newInvoice = 'ZIS-0001';
            }

        $title = "Booking Form";
        return view("pages.client-booking.booking",compact('title','newInvoice'));
    }

    function issued_tickets(){
        $title = "Issued Tickets";
        return view('pages.client-booking.issued-tickets',compact('title'));
    }
    function cancelled_booking(){
        $title = "Cancelled Booking";
        $cancelled_booking = DB::table('customer_details')->where('BookingStatus','=','Cancelled')->get();
        return view('pages.client-booking.cancelled-booking',compact('title','cancelled_booking'));
    }
    function hold_bookings(){
        $title = "Hold Bookings";
        return view('pages.client-booking.hold-bookings',compact('title'));
    }
    function search_bookings(){
        $tableName = 'customer_details';
        $col_name = Schema::getColumnListing($tableName);
        $title = "Search Bookings";
        return view('pages.client-booking.search-bookings',compact('title','col_name'));
    }
      function store_booking(Request $request){

        $customer_data=array(
        'CustomerName'=> $request->CustomerName,
        'CustomerAddress'=> $request->CustomerAddress,
        'CustomerEmail'=> $request->CustomerEmail,
        'CustomerPhone'=> $request->CustomerPhone,
        'CustomerCity'=> $request->CustomerCity,
        'CustomerPostCode'=> $request->CustomerPostCode,
        'InvoiceNo'=> $request->InvoiceNo,
        'InvoiceDate'=> $request->InvoiceDate,
        'BookingDate'=> $request->InvoiceDate,
        'AirlineConfirmation'=> $request->AirlineConfirmation,
        'AgentName'=> $request->AgentName,
        'AgentID'=> Auth::user()->id,
        'DepartureAirport'=> $request->DepartureAirport,
        'FlightType'=> $request->FlightType,
        'FlightVia'=> $request->FlightVia,
        'DepartureDate'=> $request->DepartureDate,
        'ReturnDate'=> $request->ReturnDate,
        'CabinClass'=> $request->CabinClass,
        'PNRDetails'=> $request->PNRDetails,
        'Airline'=>$request->Airline,
        'FlightPNR'=>$request->FlightPNR,
        'FlightGDS'=>$request->FlightGDS,
        'PNRExpiry'=>$request->PNRExpiry,
        'FareExpiry'=>$request->FareExpiry,
        'BookingNote'=>$request->BookingNote,
        'DestinationAirport'=> $request->DestinationAirport,
        'SupplierRef'=> $request->SupplierRef,
        'SupplierAgent'=> $request->SupplierAgent,
        'FlightSupplier' => $request->FlightSupplier,
        'BookingSource' => $request->BookingSource,
        'BookingStatus'=> 'Pending');

         if($request->ajax()){
          $rules = array(
            'PassengerName.*'=>'required',
            'SeatQty.*'=>'required',
            'SeatPrice.*'=>'required',
            'BookingFee.*'=>'required',
            'PassengerDOB.*'=>'required',
            'PassengerType.*'=>'required',

          );
          $error = Validator::make($request->all(), $rules);
          if($error->fails())
          {
           return response()->json([
            'error'  => $error->errors()->all()
           ]);
          }
          $customerID = DB::table('customer_details')->insertGetId($customer_data);


          // Recipt Detail


            $_PayingBy = $request->PayingBy;
            $_ReciptMode = $request->ReciptMode;
            $_PaymentDueDate = $request->PaymentDueDate;
            $_CardHolderName = $request->CardHolderName;
            $_CardNo = $request->CardNo;
            $_ExpiryMonth = $request->ExpiryMonth;
            $_ExpiryYear = $request->ExpiryYear;
            $_CVV = $request->CVV;

            $_BasicAmount = $request->BasicAmount;
            $_TaxAmount = $request->TaxAmount;
            $_APCAmount = $request->APCAmount;
            $_SAFIAmount = $request->SAFIAmount;
            $_BankFee = $request->BankFee;
            $_CardFee = $request->CardFee;
            $_APCPayable = $request->APCPayable;
            $_Misc = $request->Misc;

            $ticket_cost = array(
                'CustomerID'=> $customerID,
                'AgentID'=> Auth::user()->id,
                'InvoiceNo'=> $request->InvoiceNo,
                'BasicAmount'=>$_BasicAmount,
                'TaxAmount'=>$_TaxAmount,
                'APCAmount'=>$_APCAmount,
                'SAFIAmount'=>$_SAFIAmount,
                'BankFee'=>$_BankFee,
                'CardFee'=>$_CardFee,
                'APCPayable'=>$_APCPayable,
                'Misc'=>$_Misc,
                );





            if($_ReciptMode === "Credit Card" || $_ReciptMode === "Debit Card"){
                $rules = array(
                    'CardHolderName' => 'required',
                    'CardNo' => 'required',
                    'ExpiryMonth' => 'required',
                    'ExpiryYear' => 'required',
                    'CVV' => 'required',
                );
                $error = Validator::make($request->all(), $rules);
                if($error->fails()){
                    return response()->json([
                    'error'  => $error->errors()->all()
                ]);
                }
                else{
                    $recipt_data = array(
                'CustomerID'=> $customerID,
                'InvoiceNo'=> $request->InvoiceNo,
                'AgentID'=> Auth::user()->id,
                'PayingBy' => $_PayingBy,
                'ReciptMode' => $_ReciptMode,
                'PaymentDueDate' => $_PaymentDueDate,
                'CardHolderName' => $_CardHolderName,
                'CardNo' => $_CardNo,
                'CardExpiry' => $_ExpiryMonth ."/". $_ExpiryYear,
                'CVV' => $_CVV);
                    DB::table('recipt_details')->insert($recipt_data);
                }
            }else{

            $recipt_data = array(
                'CustomerID'=> $customerID,
                'InvoiceNo'=> $request->InvoiceNo,
                'AgentID'=> Auth::user()->id,
                'PayingBy' => $_PayingBy,
                'ReciptMode' => $_ReciptMode,
                'PaymentDueDate' => $_PaymentDueDate,
                );
                DB::table('recipt_details')->insert($recipt_data);
            }

            $passengerName = $request->PassengerName;
            $seatQty = $request->SeatQty;
            $seatPrice = $request->SeatPrice;
            $bookingFee = $request->BookingFee;
            $passengerDOB = $request->PassengerDOB;
            $passengerType = $request->PassengerType;
         for($count = 0; $count < count($passengerName); $count++)
          {
           $data = array(
            'CustomerID'=> $customerID,
            'InvoiceNo'=> $request->InvoiceNo,
            'AgentID'=> Auth::user()->id,
            'PassengerName'=>$passengerName[$count],
            'SeatQty'=>$seatQty[$count],
            'SeatPrice'=>$seatPrice[$count],
            'BookingFee'=>$bookingFee[$count],
            'PassengerDOB'=>$passengerDOB[$count],
            'PassengerType'=>$passengerType[$count]
           );
           $insert_data[] = $data;
          }
         DB::table('customer_booking_details')->insert($insert_data);
         DB::table('ticket_cost')->insert($ticket_cost);
        return redirect()->route('booking-flight')->with('success','Data has been saved Successfully!');

        }
    }

      function search(Request $request){
        $searchValue = $request->input('searchby');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = DB::table('customer_details')->whereBetween('CreatedAt', [$startDate, $endDate])->get();
        return ['data' => $data];
    }

}
