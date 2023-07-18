<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    

public function update(Request $request)
    {
        if ($request->ajax()) {
            // Assuming 'passenger_details' is a collection of passenger data, you can replace it with your data source
            foreach ($request->passenger_details as $data) {
                // Assuming 'id' is the primary key for the passenger record
                $passengerId = $data['pk'];

                // Assuming 'name' is the column name to be updated and 'value' is the new value for that column
                $field = $data['name'];
                $value = $data['value'];

                // Update the passenger record with the new value
                DB::table('passengers')->where('CustomerID', $passengerId)->update([
                    $field => $value
                ]);
            }

            return response()->json(['success' => true]);
        }
    }

    
}
