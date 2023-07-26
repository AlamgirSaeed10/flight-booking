<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function update(Request $request)
    {
        $bookingID = $request->pk; // BookingID from the data-pk attribute in HTML
        $fieldName = $request->name; // Field name from the data-name attribute in HTML
        $fieldValue = $request->value; // New value from the editable field

        // Update the field based on the field name
        $affectedRows = DB::table('customer_booking_details')
            ->where('BookingID', $bookingID)
            ->update([$fieldName => $fieldValue]);

        if ($affectedRows) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Failed to update field']);
    }
}
