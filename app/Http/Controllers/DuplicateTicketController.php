<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DuplicateTicketController extends Controller
{
    public function duplicate_ticket(Request $request)
    {
        $invoiceNo = $request->duplicate_invoice_id;

        $customer_booking_details = DB::table('customer_booking_details')->where('AgentID', \auth()->id())->where('InvoiceNo', $invoiceNo)->get();
        $customer_details = DB::table('customer_details')->where('AgentID', \auth()->id())->where('InvoiceNo', $invoiceNo)->get();
        $recipt_details = DB::table('recipt_details')->where('AgentID', \auth()->id())->where('InvoiceNo', $invoiceNo)->get();

        $data = array([
            'CustomerID' => $customer_booking_details[0]->CustomerID,
            'BookingID' => $customer_booking_details[0]->BookingID,
            'InvoiceNo' => $customer_booking_details[0]->InvoiceNo,
            'AgentID' => $customer_booking_details[0]->AgentID,
            'PassengerName' => $customer_booking_details[0]->PassengerName,
            'PassengerDOB' => $customer_booking_details[0]->PassengerDOB,
            'PassengerType' => $customer_booking_details[0]->PassengerType,
            'SeatQty' => $customer_booking_details[0]->SeatQty,
            'SeatPrice' => $customer_booking_details[0]->SeatPrice,
            'BookingFee' => $customer_booking_details[0]->BookingFee,
            'CustomerName' => $customer_details[0]->CustomerName,
            'CustomerAddress' => $customer_details[0]->CustomerAddress,
            'CustomerEmail' => $customer_details[0]->CustomerEmail,
            'CustomerPhone' => $customer_details[0]->CustomerPhone,
            'CustomerCity' => $customer_details[0]->CustomerCity,
            'CustomerPostCode' => $customer_details[0]->CustomerPostCode,
            'InvoiceDate' => $customer_details[0]->InvoiceDate,
            'SupplierRef' => $customer_details[0]->SupplierRef,
            'SupplierAgent' => $customer_details[0]->SupplierAgent,
            'AirlineConfirmation' => $customer_details[0]->AirlineConfirmation,
            'Airline' => $customer_details[0]->Airline,
            'AgentName' => $customer_details[0]->AgentName,
            'DepartureAirport' => $customer_details[0]->DepartureAirport,
            'DepartureDate' => $customer_details[0]->DepartureDate,
            'CabinClass' => $customer_details[0]->CabinClass,
            'DestinationAirport' => $customer_details[0]->DestinationAirport,
            'ReturnDate' => $customer_details[0]->ReturnDate,
            'FlightType' => $customer_details[0]->FlightType,
            'FlightVia' => $customer_details[0]->FlightVia,
            'FlightPNR' => $customer_details[0]->FlightPNR,
            'PNRExpiry' => $customer_details[0]->PNRExpiry,
            'FlightGDS' => $customer_details[0]->FlightGDS,
            'FlightSupplier' => $customer_details[0]->FlightSupplier,
            'FareExpiry' => $customer_details[0]->FareExpiry,
            'BookingDate' => $customer_details[0]->BookingDate,
            'BookingStatus' => $customer_details[0]->BookingStatus,
            'PNRDetails' => $customer_details[0]->PNRDetails,
            'BookingNote' => $customer_details[0]->BookingNote,
            'BookingSource' => $customer_details[0]->BookingSource,
            'TicketDetail' => $customer_details[0]->TicketDetail,
            'ReciptID' => $recipt_details[0]->ReciptID,
            'PayingBy' => $recipt_details[0]->PayingBy,
            'ReciptMode' => $recipt_details[0]->ReciptMode,
            'ReciptImage' => $recipt_details[0]->ReciptImage,
            'PaymentDueDate' => $recipt_details[0]->PaymentDueDate,
            'BankName' => $recipt_details[0]->BankName,
            'BankAmount' => $recipt_details[0]->BankAmount,
            'CardAmount' => $recipt_details[0]->CardAmount,
            'CashAmount' => $recipt_details[0]->CashAmount,
            'OtherAmount' => $recipt_details[0]->OtherAmount,
            'CardHolderName' => $recipt_details[0]->CardHolderName,
            'CardNo' => $recipt_details[0]->CardNo,
            'CardExpiry' => $recipt_details[0]->CardExpiry,
            'CVV' => $recipt_details[0]->CVV,
            'PaymentDate' => $recipt_details[0]->PaymentDate,
            'RequestNote' => $recipt_details[0]->RequestNote,
        ]);


        if ($request->ajax()) {
            DB::table('duplicate_tickets')->insert($data);
            return response()->json(['message' => 'Duplicate ticket has been generated! 😊 ']);
        }
        return redirect()->back()->with('success', 'Duplicate ticket has been generated!');

    }

    public function view_duplicate()
    {
        $view_dup = DB::table('duplicate_tickets')->where('AgentID', auth()->id())->get();
        return view('pages.administration.duplicate-ticket', compact('view_dup'));

    }

    public function delete_duplicate(Request $request , $InvoiceNo)
    {

        if($request->ajax()){
            DB::table('duplicate_tickets')->where('InvoiceNo',$InvoiceNo)->delete();
            return response()->json(['message'=>'Duplicate ticket has been deleted!']);
        }
    }

    public function generatePDF($invoiceNo)
    {

      $data = DB::table('duplicate_tickets')->where('InvoiceNo',$invoiceNo)->get()->toArray();

        view()->share('pdf',$data);
        $pdf = PDF::loadView('pages.administration.pdf', $data);
        return $pdf->download('combined_table.pdf');
    }

}
