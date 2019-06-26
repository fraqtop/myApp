<?php

namespace App\Http\Controllers\Api;

use App\Models\Football\Location;
use App\Models\Football\Player;
use App\Http\Controllers\Controller;

class NationalitiesController extends Controller
{
    public function index()
    {
        $locations = Location::paginate(10);
        return $locations;
    }

    public function show(int $id)
    {
        return Player::where('nationalityId', '=', $id)->get();
    }
}
