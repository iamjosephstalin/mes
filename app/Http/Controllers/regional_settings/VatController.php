<?php

namespace App\Http\Controllers\regional_settings;

use App\Http\Controllers\Controller;
use App\Models\VatRate;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\JsonResponse;

class VatController extends Controller
{
  public function index()
  {
    $vatRates = VatRate::whereNull('deleted_at')->get();
    return view('content.regional-settings.vat-rate-index', compact('vatRates'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) : RedirectResponse
  {
      try {
        VatRate::create($request->all());
        return redirect()->route('vat-rates.index')->withSuccess('New vat rate has been added');
      }catch(QueryException $e){
        if ($e->errorInfo[1] == 1062) {
          return redirect()->route('vat-rates.index')->withErrors($request->vat_rate.' vat rate name already exists.');
        }
      } catch (Exception $e) {
          return redirect()->route('vat-rates.index')->withErrors('An error occurred while adding the vat rate.');
      } 
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(VatRate $vatRate) : JsonResponse
  {
    try {

        $responseData = [
            'vatRate' => $vatRate,
        ];
        return response()->json($responseData, 200);
    } catch (Exception $e) {
        return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, VatRate $vatRate) : RedirectResponse
  {
    try {
      $vatRate->update($request->all());
      return redirect()->back()
              ->withSuccess('Vat rate has been updated.');
    }catch(QueryException $e){
      if ($e->errorInfo[1] == 1062) {
        return redirect()->back()->withErrors($request->vat_rate.' vat rate name already exists.');
      }
    }
    catch (Exception $e) {
      return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(VatRate $vatRate) : RedirectResponse
  {
      $vatRate->delete();
      return redirect()->route('vat-rates.index')
              ->withSuccess('Vat Rate has been deleted.');
  }

   /**
   * Update the default currency.
   */
  public function updateDefault(Request $request) : JsonResponse
  {
      if($request->is_default){
        VatRate::where('id', '!=', $request->id)->update(['is_default' => 0]);
      }
      VatRate::find($request->id)->update(["is_default"=>$request->is_default]);
      return response()->json(['success'=>true],200);
  }
}
