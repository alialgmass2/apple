<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Region;

class FilterController extends Controller
{
    public function citiesByRegion(Region $region)
    {
        $name = "name";
//  GET CODES
        $cities = $region->cities;
        $response = [];
        foreach ($cities as $city) {
            $response[] = ["id" => $city->id, "text" => $city->translate($name)];
        }
        return response()
            ->json($response);

    }
}
