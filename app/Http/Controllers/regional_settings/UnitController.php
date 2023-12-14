<?php

namespace App\Http\Controllers\regional_settings;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
      $units = Unit::whereNull('deleted_at')->get();
      return view('content.regional-settings.unit-list', compact('units'));
    }
}
