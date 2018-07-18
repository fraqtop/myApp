<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrafficController extends Controller
{
    public function getTraffic()
    {
        return view('admin.traffic');
    }
}
