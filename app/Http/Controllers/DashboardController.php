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

    function agent_registration(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'Role' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'Role' => $request->Role,
            'password' => Hash::make($request->password),
        );

        $agent = DB::table('users')->insert($data);

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

    public function admin_profile()
    {
        $admin_data = DB::table('users')->where('id', auth()->id())->get();
        $invoice = DB::table('recipt_details')->where('AgentID', auth()->id())->get();
        $total = DB::table('customer_details')->where('BookingStatus', 'Pending')->get();
        $clients = DB::select("SELECT cd.AgentID, SUM(CAST(cb.SeatPrice AS DECIMAL(10, 2))) AS TotalSeatPrice, SUM(CAST(cd.FareExpiry AS DECIMAL(10, 2))) AS TotalFareExpiry FROM customer_booking_details cb JOIN customer_details cd ON cb.AgentID = cd.AgentID GROUP BY cd.AgentID");
        return view('pages.administration.admin-profile', compact('admin_data', 'invoice', 'total', 'clients'));
    }

    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password'))
        ];

        DB::table('users')->where('id', auth()->id())->where('email', $data['email'])->update($data);

        return redirect()->back()->with('success', 'Password updated successfully...!');

    }

    public function view_agent_profile($AgentID)
    {
        $agent_profile = DB::table('users')->where('id', $AgentID)->get();
        $invoice = DB::table('recipt_details')->where('AgentID', $AgentID)->get();
        $total = DB::table('customer_details')->where('AgentID', $AgentID)->where('BookingStatus', 'Pending')->get();
        $clients = DB::table('customer_booking_details')->where('AgentID', $AgentID)->get();
        $total_price = DB::table('customer_booking_details')
            ->select(DB::raw("SUM(SeatQty * SeatPrice) as total_price"))
            ->where('AgentID', '=', $AgentID)
            ->get();
//        return $clients;
        return view('pages.administration.agent_profile', compact('agent_profile', 'invoice', 'total', 'clients', 'total_price'));

    }

    public function block_agent(Request $request)
    {
        $agentId = $request->agent_id;

        if ($request->ajax()) {
            $agent = DB::table('users')->where('id', $agentId)->first();

            if ($agent) {
                if ($agent->IsActive == 0) {
                    DB::table('users')->where('id', $agentId)->update(['IsActive' => 1]);
                } else if ($agent->IsActive == 1) {
                    DB::table('users')->where('id', $agentId)->update(['IsActive' => 0]);
                }
                return response()->json(['message' => 'Agent status updated successfully.']);
            } else {
                return response()->json(['message' => 'Agent not found.'], 404);
            }
        }
    }

    public function update_agent_profile(Request $request)
    {
        $user_id = $request->user_id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password'))
        ];
        $user = DB::table('users')->where('id', $user_id)->where('email', $data['email'])->get();
        if ($user[0]->IsActive == 0) {
            return redirect()->back()->with('error', 'This user is blocked by Super Admin please unblock to update the password');
        } else {

            DB::table('users')->where('id', $user_id)->where('email', $data['email'])->update($data);
            return redirect()->back()->with('success', 'Password updated successfully...!');
        }


    }
}
