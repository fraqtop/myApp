<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrafficController extends Controller
{
    public function showTraffic()
    {
        return view('admin.traffic');
    }
}
