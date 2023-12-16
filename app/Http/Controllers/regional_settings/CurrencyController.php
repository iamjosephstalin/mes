<?php

namespace App\Http\Controllers\regional_settings;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{

    public function index()
    {
      $currencies = Currency::whereNull('deleted_at')->get();
      return view('content.regional-settings.currency-index', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        try {
          Currency::create($request->all());
          return redirect()->route('currencies.index')->withSuccess('New currency has been added');
        }catch(QueryException $e){
          if ($e->errorInfo[1] == 1062) {
            return redirect()->route('currencies.index')->withErrors($request->currency_name.' currency name already exists.');
          }
        } catch (Exception $e) {
            return redirect()->route('currencies.index')->withErrors('An error occurred while adding the currency.');
        } 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency) : JsonResponse
    {
      try {

          $responseData = [
              'currency' => $currency,
          ];
          return response()->json($responseData, 200);
      } catch (Exception $e) {
          return response()->json(['error' => 'An error occurred'], 500);
      }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency) : RedirectResponse
    {
      try {
        $currency->update($request->all());
        return redirect()->back()
                ->withSuccess('Currency has been updated.');
      }catch(QueryException $e){
        if ($e->errorInfo[1] == 1062) {
          return redirect()->back()->withErrors($request->currency_name.' currency name already exists.');
        }
      }
      catch (Exception $e) {
        return response()->json(['error' => 'An error occurred'], 500);
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency) : RedirectResponse
    {
        $currency->delete();
        return redirect()->route('currencies.index')
                ->withSuccess('Currency has been deleted.');
    }

     /**
     * Update the default currency.
     */
    public function updateDefault(Request $request) : JsonResponse
    {
        if($request->is_default){
          Currency::where('id', '!=', $request->id)->update(['is_default' => 0]);
        }
        Currency::find($request->id)->update(["is_default"=>$request->is_default]);
        return response()->json(['success'=>true],200);
    }


}
