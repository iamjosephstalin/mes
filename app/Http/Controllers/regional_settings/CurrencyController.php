<?php

namespace App\Http\Controllers\regional_settings;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    public function index()
    {
      $currencies = Currency::whereNull('deleted_at')->get();
      return view('content.regional-settings.currency-list', compact('currencies'));
    }
}
