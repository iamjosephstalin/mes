<?php

namespace App\Http\Controllers\clock_history;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClockHistory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Exception;

class ClockHistoryController extends Controller
{
  public function index()
  {
    $histories = ClockHistory::whereNull('deleted_at')
      ->with('user')
      ->get();
    $users = User::whereNull('deleted_at')
      ->where('status', 1)
      ->get();
    return view('content.clock-history.clock-history-index', ['histories' => $histories, 'users' => $users]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): RedirectResponse
  {
    if ($request->has('clock_out')) {
      $clockIn = Carbon::parse($request->input('clock_in'));
      $clockOut = Carbon::parse($request->input('clock_out'));
      $difference = $clockIn->diff($clockOut);
      $formattedDifference = sprintf(
        '%02d:%02d:%02d',
        $difference->h + $difference->days * 24,
        $difference->i,
        $difference->s
      );
      $request->merge(['working_time' => $formattedDifference]);
    }
    ClockHistory::create($request->all());
    return redirect()
      ->route('clock-history.index')
      ->withSuccess('New Clock-in/Clock-out history has been added');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(ClockHistory $clockHistory): JsonResponse
  {
    try {
      $responseData = [
        'clockHistory' => $clockHistory,
      ];
      return response()->json($responseData, 200);
    } catch (Exception $e) {
      return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, ClockHistory $clockHistory): RedirectResponse
  {
    try {
      if ($request->has('clock_out')) {
        $clockIn = Carbon::parse($request->input('clock_in'));
        $clockOut = Carbon::parse($request->input('clock_out'));
        $difference = $clockIn->diff($clockOut);
        $formattedDifference = sprintf(
          '%02d:%02d:%02d',
          $difference->h + $difference->days * 24,
          $difference->i,
          $difference->s
        );
        $request->merge(['working_time' => $formattedDifference]);
      }
      $clockHistory->update($request->all());
      return redirect()
        ->route('clock-history.index')
        ->withSuccess('Clock-in/Clock-out history has been updated');
    } catch (Exception $e) {
      return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(ClockHistory $clockHistory): RedirectResponse
  {
    $clockHistory->delete();
    return redirect()
      ->route('clock-history.index')
      ->withSuccess('Clock-in/Clock-out history has been deleted.');
  }

  public function clockInOutView()
  {
    return view('content.clock-history.clock-in-out-index');
  }
}
