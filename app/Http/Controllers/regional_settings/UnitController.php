<?php

namespace App\Http\Controllers\regional_settings;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\JsonResponse;

class UnitController extends Controller
{
  public function index()
  {
    $units = Unit::whereNull('deleted_at')->get();
    return view('content.regional-settings.unit-index', compact('units'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) : RedirectResponse
  {
      try {
        Unit::create($request->all());
        return redirect()->route('units.index')->withSuccess('New unit has been added');
      }catch(QueryException $e){
        if ($e->errorInfo[1] == 1062) {
          return redirect()->route('units.index')->withErrors($request->unit.' unit name already exists.');
        }
      } catch (Exception $e) {
          return redirect()->route('units.index')->withErrors('An error occurred while adding the unit.');
      } 
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Unit $unit) : JsonResponse
  {
    try {

        $responseData = [
            'unit' => $unit,
        ];
        return response()->json($responseData, 200);
    } catch (Exception $e) {
        return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Unit $unit) : RedirectResponse
  {
    try {
      $unit->update($request->all());
      return redirect()->back()
              ->withSuccess('Unit has been updated.');
    }catch(QueryException $e){
      if ($e->errorInfo[1] == 1062) {
        return redirect()->back()->withErrors($request->unit.' unit name already exists.');
      }
    }
    catch (Exception $e) {
      return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Unit $unit) : RedirectResponse
  {
      $unit->delete();
      return redirect()->route('units.index')
              ->withSuccess('Unit has been deleted.');
  }

   /**
   * Update the default currency.
   */
  public function updateDefault(Request $request) : JsonResponse
  {
      if($request->is_default){
        Unit::where('id', '!=', $request->id)->update(['is_default' => 0]);
      }
      Unit::find($request->id)->update(["is_default"=>$request->is_default]);
      return response()->json(['success'=>true],200);
  }
}
