<?php

namespace App\Http\Controllers\addtional_fields;

use App\Http\Controllers\Controller;
use App\Models\AdditionalField;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdditionalFieldsController extends Controller
{
    public function index()
    {
      $additionalFields = AdditionalField::whereNull('deleted_at')->get();
      return view('content.additional-fields.additional-fields-index', compact('additionalFields'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        try {
          AdditionalField::create($request->all());
          return redirect()->route('additional-fields.index')->withSuccess('An additional field has been added');
        } catch (Exception $e) {
            return redirect()->route('additional-fields.index')->withErrors('An error occurred while adding the additional field.');
        } 
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdditionalField $additionalField) : JsonResponse
    {
      try {
  
          $responseData = [
              'additionalField' => $additionalField,
          ];
          return response()->json($responseData, 200);
      } catch (Exception $e) {
          return response()->json(['error' => 'An error occurred'], 500);
      }
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdditionalField $additionalField) : RedirectResponse
    {
      try {
        $additionalField->update($request->all());
        return redirect()->back()
                ->withSuccess('Additional field has been updated.');
      }
      catch (Exception $e) {
        return response()->json(['error' => 'An error occurred'], 500);
      }
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdditionalField $additionalField) : RedirectResponse
    {
        $additionalField->delete();
        return redirect()->route('additional-fields.index')
                ->withSuccess('Additional field has been deleted.');
    }
  
}
