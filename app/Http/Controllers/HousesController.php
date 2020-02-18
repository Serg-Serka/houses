<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HousesController extends Controller
{
    public function searchForm()
    {
        return view('houses');
    }

    public function search(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'club' => 'numeric',
            'country' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        return response()->json(['success'=>'Record is successfully added']);

//        return $request->all();

    }

}
