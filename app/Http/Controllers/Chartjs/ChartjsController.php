<?php

namespace App\Http\Controllers\Chartjs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChartjsController extends Controller
{
    public function index() {
        return view('chartjs.index') ;
    }
}
