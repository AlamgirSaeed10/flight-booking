<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {

        return view('pages.dashboard');
    }

    function agent_form()
    {
        return view('auth.register');
    }

    public function agent_registration(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'Role' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adding image validation rule
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imageName = auth()->id() . '-' . $request->name . '.' . $request->file('image')->getClientOriginalExtension();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'Role' => $request->Role,
            'password' => Hash::make($request->password),
            'image' => $imageName,
        ];

//        $request->file('image')->storeAs('assets/images/users', $imageName);
        $request->image->move(public_path('assets/images/users/'), $imageName);
        DB::table('users')->insert($data);

        return redirect()->back()->with('success', 'Agent has been registered successfully!');
    }

    function agents_details()
    {
        $agent_detail = DB::table('users')->get();
        return view('pages.administration.agents-details', compact('agent_detail'));
    }

    function invoice($InvoiceNo)
    {
        $customer_details = DB::table('customer_details')->where('AgentID', Auth::user()->id)->where('InvoiceNo', $InvoiceNo)->get();
        $recipt_details = DB::table('recipt_details')->where('AgentID', Auth::user()->id)->where('InvoiceNo', $InvoiceNo)->get();
        $ticket_cost = DB::table('ticket_cost')->where('AgentID', Auth::user()->id)->where('InvoiceNo', $InvoiceNo)->get();
        $passanger_details = DB::table('customer_booking_details')->where('AgentID', Auth::user()->id)->where('InvoiceNo', $InvoiceNo)->get();
        return view('pages.administration.gen-invoice', compact('customer_details', 'recipt_details', 'ticket_cost', 'passanger_details'));
    }
}



