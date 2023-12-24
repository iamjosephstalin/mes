<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
  {
    $clients = Client::whereNull('deleted_at')->get();
    return view('content.clients.clients-index', compact('clients'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) : RedirectResponse
  {
      try {
        Client::create($request->all());
        return redirect()->route('clients.index')->withSuccess('New Client has been added');
      } catch (Exception $e) {
          return redirect()->route('clients.index')->withErrors('An error occurred while adding the Client.');
      } 
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Client $client) : JsonResponse
  {
    try {

        $responseData = [
            'client' => $client,
        ];
        return response()->json($responseData, 200);
    } catch (Exception $e) {
        return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Client $client) : RedirectResponse
  {
    try {
      $client->update($request->all());
      return redirect()->back()
              ->withSuccess('Client has been updated.');
    }
    catch (Exception $e) {
      return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Client $client) : RedirectResponse
  {
      $client->delete();
      return redirect()->route('clients.index')
              ->withSuccess('client has been deleted.');
  }

}
