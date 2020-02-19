<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Houses extends Model
{
    public static function selectListOfHouses($data)
    {
        foreach ($data as $key => $value) {
            if ($value === null) {
                unset($data[$key]);
            }
        }

        $query = "return DB::table('houses')->select('name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages')";
        foreach ($data as $key => $value) {
            if ($key == 'name') {
                $operator = 'LIKE';
                $value = "%".$value."%";
            } elseif ($key == 'minPrice' || $key == 'maxPrice') {
                $query .= "->whereBetween('price', [" . $data['minPrice'] . ", " . $data['maxPrice'] . "])";
                break;
            }

            else { $operator = '='; }

            $query .= "->where('". $key . "' , '" . $operator . "'  , '" .$value . "')";
        }
        $query .= "->get();";
//        return $query;
        return eval($query);
    }
}
