<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function reports()
    {

        return view('pages.administration.reports');

    }

    public function getReportData(Request $request)
    {

        return $request;
    }

    public function searchBookingsByDate(Request $request)
    {
        $searchValue = $request->searchby;
        $startDate = $request->startdate;
        $endDate = $request->enddate;

        $query = \Illuminate\Support\Facades\DB::table('customer_details');

        if ($searchValue === "bkg_date") {
            $column = 'BookingDate';
        } else if ($searchValue === "flt_departuredate") {
            $column = 'DepartureDate';
        } else if ($searchValue === "isu_date") {
            $column = 'CreatedAt';
        } else if ($searchValue === "cnl_date") {
            $column = 'CancellationDate';
        }
        if (isset($column)) {
            $query->whereBetween($column, [$startDate, $endDate]);
            $data = $query->get();
        } else {
            $data = [];
        }
        return ['data' => $data];

    }

    public function searchBookingsByValue(Request $request)
    {
        $searchby = $request->searchby;
        $searchvalue = $request->searchvalue;

        $query = DB::table('customer_details');

        if ($searchby === "bkg_no") {
            $column = 'InvoiceNo';
        } else if ($searchby === "p_firstname") {
            $column = 'CustomerName';
        } else if ($searchby === "flt_pnr") {
            $column = 'FlightPNR';
        } else if ($searchby === "p_eticket_no") {
            $column = 'InvoiceNo';
        } else if ($searchby === "flt_gds") {
            $column = 'FlightGDS';
        } else if ($searchby === "flt_airline") {
            $column = 'Airline';
        } else if ($searchby === "bkg_supplier_reference") {
            $column = 'SupplierRef';
        } else if ($searchby === "cst_mobile") {
            $column = 'CustomerPhone';
        } else if ($searchby === "cst_email") {
            $column = 'CustomerEmail';
        }
        if (isset($column)) {
            $query->where($column, 'LIKE', '%' . $searchvalue . '%');
            $data = $query->get();
        } else {
            $data = [];
        }
        return ['data' => $data];
    }


    public function supplierReport(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $supplier = $request->supplier;

        $data = DB::table('customer_details')->where("FlightSupplier","=",$supplier)->whereBetween("BookingDate" , [$start_date,$end_date])->get();

        return ['data' => $data];
    }
}
