<?php

namespace App\Http\Controllers\machines_operations;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\MachinesOperations;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MachinesOperationsController extends Controller
{
    public function index()
    {
      $machinesOperations = MachinesOperations::whereNull('deleted_at')->with('currency')->get();
      return view('content.machines_operations.machines-operations-index', compact('machinesOperations'));
    }

    public function create()
    {
      $currencies = Currency::whereNull('deleted_at')->get();
      return view('content.machines_operations.machines-operations-create',compact('currencies'));
    }

    public function store(Request $request) : RedirectResponse
    {
        try {
          MachinesOperations::create($request->all());
          return redirect()->route('machines-operations.index')->withSuccess('New machines/operations has been added');
         } catch (Exception $e) {
            return redirect()->route('machines-operations.index')->withErrors('An error occurred while adding the machines/operations.');
        } 
    }

    public function edit($machinesOperations)
    {

      $machinesOperations = MachinesOperations::findOrFail($machinesOperations);
        $currencies = Currency::whereNull('deleted_at')->get();
        return view('content.machines_operations.machines-operations-edit',compact('machinesOperations','currencies'));
    }

    public function update(Request $request, MachinesOperations $machinesOperations) : RedirectResponse
    {
      try {
        MachinesOperations::find($request->id)->update($request->all());
        return redirect()->route('machines-operations.index')
                ->withSuccess('Machines/operations has been updated.');
      }catch (Exception $e) {
        return redirect()->back()
        ->withErrors('An error occurred while updating Machines/operations.');
      }
    }

    public function destroy($machinesOperations) : RedirectResponse
    {
      MachinesOperations::findOrFail($machinesOperations)->delete();
        return redirect()->route('machines-operations.index')
                ->withSuccess('Machines/operations has been deleted.');
    }

}
