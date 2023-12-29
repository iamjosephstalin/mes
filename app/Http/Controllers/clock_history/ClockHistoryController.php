<?php

namespace App\Http\Controllers\clock_history;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClockHistoryController extends Controller
{
    public function index()
    {
      return view('content.clock-history.clock-history-index');
    }

    public function clockInOutView()
    {
      return view('content.clock-history.clock-in-out-index');
    }
}
