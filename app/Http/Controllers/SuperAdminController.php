<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function super_admin()
    {
        $user = DB::table('users')->get();
        return view('pages.super-admin', compact('user'));

    }

    public function single_agent($AgentID)
    {
        $users = DB::table('users')->where('id',$AgentID)->get();
        $recipt_details = DB::table('recipt_details')->where('AgentID', $AgentID)->get();
        $customer_details = DB::table('customer_details')->where('AgentID', $AgentID)->get();
        $customer_booking_details = DB::table('customer_booking_details')->where('AgentID', $AgentID)->get();


        $cd_total = DB::table('customer_details')->where('AgentID', $AgentID)->get();
        $cbd_total = DB::table('customer_booking_details')->where('AgentID', $AgentID)->get();
        $rd_total =
            DB::table('customer_booking_details')
            ->select(DB::raw("SUM(SeatQty * SeatPrice) as rd_total"))
            ->where('AgentID','=',$AgentID)
            ->get();

        return view('pages.administration.single-agent', compact( 'rd_total','cd_total','cbd_total','users', 'recipt_details', 'customer_details', 'customer_booking_details'));
    }
}
