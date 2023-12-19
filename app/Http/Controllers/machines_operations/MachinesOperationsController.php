<?php

namespace App\Http\Controllers\machines_operations;

use App\Http\Controllers\Controller;
use App\Models\MachinesOperations;
use Illuminate\Http\Request;

class MachinesOperationsController extends Controller
{
    public function index()
    {
      $machinesOperations = MachinesOperations::whereNull('deleted_at')->with('currency')->get();
      return view('content.machines_operations.machines-operations-index', compact('machinesOperations'));
    }

    public function create()
    {
      return view('content.machines_operations.machines-operations-create');
    }

}
