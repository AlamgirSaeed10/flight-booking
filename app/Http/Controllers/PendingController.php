<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PendingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function pending_tasks()
    {
        $title = "Pending Tasks";
        return view('pages.client-booking.pending-tasks', compact('title'));
    }

    function pending_tickets()
    {
        $title = "Pending Tickets";
        return view('pages.client-booking.pending-tickets', compact('title'));
    }

    function view_tickets($InvoiceNo)
    {
        $customer_details = DB::table('customer_details')->where('AgentID', Auth::user()->id)->where('InvoiceNo', $InvoiceNo)->get();
        $recipt_details = DB::table('recipt_details')->where('AgentID', Auth::user()->id)->where('InvoiceNo', $InvoiceNo)->get();
        $ticket_cost = DB::table('ticket_cost')->where('AgentID', Auth::user()->id)->where('InvoiceNo', $InvoiceNo)->get();
        $passanger_details = DB::table('customer_booking_details')->where('AgentID', Auth::user()->id)->where('InvoiceNo', $InvoiceNo)->get();
        return view('pages.client-booking.view-tickets', compact('customer_details', 'recipt_details', 'ticket_cost', 'passanger_details'));
    }

    function edit_tickets($InvoiceNo)
    {
        $customer_details = DB::table('customer_details')->where('AgentID', Auth::user()->id)->where('InvoiceNo', $InvoiceNo)->get();
        $recipt_details = DB::table('recipt_details')->where('AgentID', Auth::user()->id)->where('InvoiceNo', $InvoiceNo)->get();
        $ticket_cost = DB::table('ticket_cost')->where('AgentID', Auth::user()->id)->where('InvoiceNo', $InvoiceNo)->get();
        $passanger_details = DB::table('customer_booking_details')->where('AgentID', Auth::user()->id)->where('InvoiceNo', $InvoiceNo)->get();
        return view('pages.client-booking.update-ticket', compact('customer_details', 'recipt_details', 'ticket_cost', 'passanger_details'));
    }

    function update_recipt_detail(Request $request)
    {
        $_PaymentType = $request->PaymentType;


        $pt = str_replace(' Payment', '', $_PaymentType);
        if ($pt === 'Bank') {
            $pt .= ' Transfer';
        }


        $data = [
            'CustomerID' => $request->CustomerID,
            'AgentID' => Auth::user()->id,
            'InvoiceNo' => $request->InvoiceNo,
            'PaymentDate' => $request->PaymentDate,
            'RequestNote' => $request->RequestNote,
            'ReciptMode' => $pt,
            'BankName' => $_PaymentType === 'Bank Payment' ? $request->BankName : null,
            'BankAmount' => $_PaymentType === 'Bank Payment' ? $request->RequestAmount : 0,
            'CardAmount' => $_PaymentType === 'Card Payment' ? $request->RequestAmount : 0,
            'CashAmount' => $_PaymentType === 'Cash Payment' ? $request->RequestAmount : 0,
            'OtherAmount' => $_PaymentType === 'Other Payment' ? $request->RequestAmount : 0,
        ];
        DB::table('recipt_details')->insert($data);
        return redirect()->route('pending-tickets')->with('success', 'Payment Request has been made!');

    }

    function store_recipt_image(Request $request)
    {
        $request->validate([
            'ReciptImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image = $request->file('ReciptImage');
        if ($request->hasFile('ReciptImage')) {
            $imageName = $request->InvoiceNo . '-' . $request->CustomerID . '-' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/recipt-images'), $imageName);
            $imagePath = 'recipt-images/' . $imageName;

            $data = [
                'ReciptImage' => $imagePath,
            ];

            DB::table('recipt_details')
                ->where('CustomerID', $request->CustomerID)
                ->where('AgentID', Auth::user()->id)
                ->where('InvoiceNo', $request->InvoiceNo)
                ->update($data);

        }
        return redirect()->back()->with('success', 'Recipt has been Uploaded...!');
    }

    function update_recipt_image(Request $request)
    {
        $request->validate([
            'ReciptImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',]);

        $image = $request->file('ReciptImage');
        if ($request->hasFile('ReciptImage')) {
            $imageName = $request->InvoiceNo . '-' . $request->CustomerID . '-' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/recipt-images/'), $imageName);
            $imagePath = 'recipt-images/' . $imageName;

            $data = [
                'ReciptImage' => $imagePath,
            ];

            DB::table('recipt_details')
                ->where('CustomerID', $request->CustomerID)
                ->where('AgentID', Auth::user()->id)
                ->where('InvoiceNo', $request->InvoiceNo)
                ->update($data);

        }
        return redirect()->back()->with('success', 'Recipt has been Uploaded...!');
    }

    function cancel_ticket(Request $request)
    {
        $data = [
            'BookingStatus' => 'Cancelled',
        ];
        DB::table('customer_details')->where('CustomerID', $request->CustomerID)->where('AgentID', Auth::user()->id)->where('InvoiceNo', $request->InvoiceNo)
            ->update($data);

        return redirect()->route('pending-tickets')->with('success', 'Payment Request has been made!');

    }

    function update_tickets(Request $request, $InvoiceNo)
    {
        $_CustomerID = $request->CustomerID;
        $_InvoiceNo = $request->InvoiceNo;


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

        $customer_data = array(
            'CustomerName' => $request->CustomerName,
            'CustomerAddress' => $request->CustomerAddress,
            'CustomerEmail' => $request->CustomerEmail,
            'CustomerPhone' => $request->CustomerPhone,
            'CustomerCity' => $request->CustomerCity,
            'CustomerPostCode' => $request->CustomerPostCode,
            'InvoiceDate' => $request->InvoiceDate,
            'BookingDate' => $request->BookingDate,
            'AirlineConfirmation' => $request->AirlineConfirmation,
            'DepartureAirport' => $request->DepartureAirport,
            'FlightType' => $request->FlightType,
            'FlightVia' => $request->FlightVia,
            'DepartureDate' => $request->DepartureDate,
            'ReturnDate' => $request->ReturnDate,
            'CabinClass' => $request->CabinClass,
            'PNRDetails' => $request->PNRDetails,
            'Airline' => $request->Airline,
            'FlightPNR' => $request->FlightPNR,
            'FlightGDS' => $request->FlightGDS,
            'PNRExpiry' => $request->PNRExpiry,
            'FareExpiry' => $request->FareExpiry,
            'BookingNote' => $request->BookingNote,
            'DestinationAirport' => $request->DestinationAirport,
            'SupplierRef' => $request->SupplierRef,
            'SupplierAgent' => $request->SupplierAgent,
            'FlightSupplier' => $request->FlightSupplier,
            'BookingSource' => $request->BookingSource,
            'TicketDetail' => $request->TicketDetail
        );
        DB::table('customer_details')->where('InvoiceNo', $_InvoiceNo)->where('CustomerID', $_CustomerID)->where('AgentID', Auth::user()->id)->update($customer_data);
        // Recipt details for update

        $_ReceiptID = $request->ReciptID;
        $_PayingBy = $request->PayingBy;
        $_ReciptMode = $request->ReciptMode;
        $_PaymentDate = $request->PaymentDate;
        $_BankAmount = $request->BankAmount;


        for ($i = 0; $i < count($_ReceiptID); $i++) {
            $receiptIds = $_ReceiptID[$i];
            $paymentDate = $_PaymentDate[$i];
            $paidBy = $_PayingBy[$i];
            $recipt_mode = $_ReciptMode[$i];
            $amount = $_BankAmount[$i];

            $invoice = DB::table('recipt_details')->where('InvoiceNo', $_InvoiceNo)->where('CustomerID', $_CustomerID)->first();

            if ($invoice) {
                $invoice->PaidBy = $paidBy;
                $invoice->PaymentDate = $paymentDate;
                $invoice->ReciptMode = $recipt_mode;

                if ($recipt_mode === 'Card') {
                    $invoice->CardAmount = $amount;
                } else if ($recipt_mode === 'Bank Transfer') {
                    $invoice->BankAmount = $amount;
                } else if ($recipt_mode === 'Cash') {
                    $invoice->CashAmount = $amount;
                } else if ($recipt_mode === 'Other') {
                    $invoice->OtherAmount = $amount;
                } else {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $updateReceipt = array(
                    'PayingBy' => $paidBy,
                    'PaymentDate' => $paymentDate,
                    'PaymentDueDate' => $invoice->PaymentDueDate,
                    'ReciptMode' => $recipt_mode,
                    'CardAmount' => ($recipt_mode === 'Card') ? $amount : 0,
                    'BankAmount' => ($recipt_mode === 'Bank Transfer') ? $amount : 0,
                    'CashAmount' => ($recipt_mode === 'Cash') ? $amount : 0,
                    'OtherAmount' => ($recipt_mode === 'Other') ? $amount : 0,

                );

                DB::table('recipt_details')->where('InvoiceNo', $_InvoiceNo)->where('ReciptID', $receiptIds)->where('CustomerID', $_CustomerID)->where('AgentID', Auth::user()->id)->update($updateReceipt);
            }
        }
        return redirect()->back()->with('success', 'Passenger has been added successfully...!');
    }


}
