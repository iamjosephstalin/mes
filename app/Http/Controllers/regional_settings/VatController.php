<?php

namespace App\Http\Controllers\regional_settings;

use App\Http\Controllers\Controller;
use App\Models\VatRate;
use Illuminate\Http\Request;

class VatController extends Controller
{
    public function index()
    {
      $vatRates= VatRate::whereNull('deleted_at')->get();
      return view('content.regional-settings.vat-rate-list', compact('vatRates'));
    }
}
