<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

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
        $DateFrom = $request->input('DateFrom');
        $DateTo = $request->input('DateTo');

        $SupplierName = $request->input('SupplierName');

        if ($SupplierName && ($DateFrom && $DateTo)) {
            $data->where('SupplierName', '=', $SupplierName)
           ->whereBetween('CreatedAt', [$DateFrom, $DateTo])
           ->get();
        }
        $data = $data->get();

        return response()->json([$data]);
    }
}
