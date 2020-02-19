<?php

namespace App\Http\Controllers;

use App\Houses;
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
            'name' => 'string|max:30|nullable',
            'bedrooms' => 'integer|digits_between:0, 2|nullable',
            'bathrooms' => 'integer|digits_between:0, 2|nullable',
            'storeys' => 'integer|digits_between:0, 2|nullable',
            'garages' => 'integer|digits_between:0, 2|nullable',
            'minPrice' => 'numeric|min:100000|nullable',
            'maxPrice' => 'numeric|gte:minPrice|required_with:minPrice|nullable',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $data = $request->input();
        return response()->json(Houses::selectListOfHouses($data));

//        return $data;

    }

}
