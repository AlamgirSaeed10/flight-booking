<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
            'password' => Hash::make($request->input('password')),

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
            ->select(DB::raw("SUM((SeatQty * SeatPrice) + BookingFee) as total_price"))
            ->where('AgentID', '=', $AgentID)
            ->get();
        return view('pages.administration.agent_profile', compact('agent_profile', 'invoice', 'total', 'clients', 'total_price'));

    }

    public function block_agent(Request $request)
    {
        $agentId = $request->agent_id;

        if ($request->ajax()) {
            $agent = DB::table('users')->where('id', $agentId)->first();

            if ($agent->Role === "Super Admin") {
                return response()->json(['message' => 'Super admin can not be banned...!', 'info' => 'warning']);

            }

            if ($agent->is_blocked == 1) {
                DB::table('users')->where('id', $agentId)->update(['is_blocked' => 0]);
                return response()->json(['message' => 'Agent has been unblocked successfully.']);
            }

            if ($agent->is_blocked == 0) {
                DB::table('users')->where('id', $agentId)->update(['is_blocked' => 1]);
                return response()->json(['message' => 'Agent has been blocked successfully.']);
            }
            return response()->json(['message' => 'Agent status updated successfully.']);
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
        if ($user[0]->is_blocked === 1) {
            return redirect()->back()->with('error', 'This user is blocked by Super Admin please unblock to update the password');
        } else {

            DB::table('users')->where('id', $user_id)->where('email', $data['email'])->update($data);
            return redirect()->back()->with('success', 'Password updated successfully...!');
        }
    }

    public function delete_agent(Request $request)
    {

        $agentId = $request->del_agent_id;

        if ($request->ajax()) {
            $agent = DB::table('users')->where('id', $agentId)->first();

            if ($agent->Role === "Super Admin") {
                return response()->json(['message' => 'Super Admin can not be deleted']);

            }

            if ($agent) {
                DB::table('users')->where('id', $agentId)->delete();
                return response()->json(['message' => 'Agent deleted successfully.']);
            }
            return response()->json(['message' => 'Agent not found.']);
        }


    }

    public function admin_profile()
    {
        $AgentID = Auth::user()->id;
        $users = DB::table('users')->where('id', $AgentID)->get();
        $recipt_details = DB::table('recipt_details')->where('AgentID', $AgentID)->get();
        $customer_details = DB::table('customer_details')->where('AgentID', $AgentID)->get();
        $customer_booking_details = DB::table('customer_booking_details')->where('AgentID', $AgentID)->get();


        $cd_total = DB::table('customer_details')->where('AgentID', $AgentID)->get();
        $cbd_total = DB::table('customer_booking_details')->where('AgentID', $AgentID)->get();
        $rd_total =
            DB::table('customer_booking_details')
                ->select(DB::raw("SUM((SeatQty * SeatPrice) + BookingFee) as rd_total"))
                ->where('AgentID', '=', $AgentID)
                ->get();

        return view('pages.administration.admin-profile', compact('rd_total', 'cd_total', 'cbd_total', 'users', 'recipt_details', 'customer_details', 'customer_booking_details'));

    }
}
