<?php

namespace App\Http\Controllers\api_keys;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
  public function index()
  {
    $apiKeys = ApiKey::whereNull('deleted_at')->get();
    return view('content.api_keys.api-keys-list', ['apiKeys' => $apiKeys]);
  }

  public function create()
  {
    do {
      $apiKey = Str::uuid();
    } while (ApiKey::where('api_key', $apiKey)->exists());
    return view('content.api_keys.api-keys-create', compact('apiKey'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): RedirectResponse
  {
    try {
      $apiKey = ApiKey::where('api_key', $request->api_key)
        ->whereNull('deleted_at')
        ->first();
      if ($apiKey) {
        return redirect()
          ->route('api-keys.index')
          ->withErrors("API key '" . $request->api_key . "' already exists.");
      } else {
        $newApiKey = new ApiKey([
          'status' => $request->status,
          'api_key' => $request->api_key,
          'products' => $request->has('products'),
          'orders' => $request->has('orders'),
          'files' => $request->has('files'),
          'clients' => $request->has('clients'),
        ]);
        $newApiKey->save();
        return redirect()
          ->route('api-keys.index')
          ->withSuccess('New API Key has been added');
      }
    } catch (Exception $e) {
      return redirect()
        ->route('api-keys.index')
        ->withErrors('An error occurred while adding the API Key.');
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(int $id)
  {
    try {
      $apiKey = ApiKey::findOrFail($id);
      return view('content.api_keys.api-keys-edit', compact('apiKey'));
    } catch (Exception $e) {
      return redirect()
        ->route('api-keys.index')
        ->withErrors('An error occurred while fetching the API Key.');
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, ApiKey $apiKey): RedirectResponse
  {
    try {
      $apiKey->update([
        'status' => $request->status,
        'api_key' => $request->api_key,
        'products' => $request->has('products'),
        'orders' => $request->has('orders'),
        'files' => $request->has('files'),
        'clients' => $request->has('clients'),
      ]);
      return redirect()
        ->route('api-keys.index')
        ->withSuccess('API Key has been updated');
    } catch (Exception $e) {
      return redirect()
        ->route('api-keys.index')
        ->withErrors('An error occurred while updating the API Key.');
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(ApiKey $apiKey): RedirectResponse
  {
    $apiKey->delete();
    return redirect()
      ->route('api-keys.index')
      ->withSuccess('API Key has been deleted.');
  }
}
