<?php

namespace App\Http\Controllers\clock_history;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClockHistory;
use App\Models\ClockPauseHistory;
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
    if ($request->has('clock_in') && $request->has('clock_out')) {
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
      $route = 'clock-history.index';
      $msg = 'New Clock-in/Clock-out history has been added';
    } else {
      $clockIn = date('Y-m-d H:i:s');
      $request->merge(['clock_in' => $clockIn, 'in_work' => true]);
      $route = 'clock-in-out-view';
      $msg = 'Work started.';
    }
    ClockHistory::create($request->all());
    return redirect()
      ->route($route)
      ->withSuccess($msg);
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
      if ($request->has(['clock_in', 'clock_out'])) {
        $clockIn = Carbon::parse($request->input('clock_in'));
        $clockOut = Carbon::parse($request->input('clock_out'));
        $route = 'clock-history.index';
        $msg = 'Clock-in/Clock-out history has been updated';
      } else {
        $now = now();
        $clockIn = Carbon::parse($clockHistory->clock_in);
        $clockOut = $now;
        $request->merge(['in_work' => false, 'clock_out' => $now]);
        $route = 'clock-in-out-view';
        $msg = 'Work stopped.';
      }
      $difference = $clockIn->diff($clockOut);
      $formattedDifference = sprintf(
        '%02d:%02d:%02d',
        $difference->h + $difference->days * 24,
        $difference->i,
        $difference->s
      );
      $workingTime = $clockHistory->pause_time
        ? $this->subtractTimes($formattedDifference, $clockHistory->pause_time)
        : $formattedDifference;
      $request->merge(['working_time' => $workingTime]);
      $clockHistory->update($request->all());
      return redirect()
        ->route($route)
        ->withSuccess($msg);
    } catch (Exception $e) {
      return redirect()
        ->route($route)
        ->withErrors('An error occurred while updating the Clock-in/Clock-out history.');
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
    $loginUserId = auth()->user()->id;
    $histories = ClockHistory::whereNull('deleted_at')
      ->where('user_id', $loginUserId)
      ->with([
        'user',
        'pause' => function ($query) {
          $query->orderBy('id', 'desc');
        },
      ])
      ->orderBy('id', 'desc')
      ->get();
    $lastHistory = ClockHistory::whereNull('deleted_at')
      ->where('user_id', $loginUserId)
      ->with([
        'pause' => function ($query) {
          $query->orderBy('id', 'desc')->first();
        },
      ])
      ->orderBy('id', 'desc')
      ->first();
    return view('content.clock-history.clock-in-out-index', [
      'histories' => $histories,
      'lastHistory' => $lastHistory,
    ]);
  }

  /**
   * Show the form for user to clock in.
   */
  public function clockIn(): JsonResponse
  {
    try {
      $loginUserId = auth()->user()->id;
      $hasHistory = ClockHistory::where('in_work', true)
        ->where('user_id', $loginUserId)
        ->whereNull('deleted_at')
        ->exists();
      $responseData = [
        'hasHistory' => $hasHistory,
      ];
      return response()->json($responseData, 200);
    } catch (Exception $e) {
      return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Show the form for user to clock out.
   */
  public function clockOut(): JsonResponse
  {
    try {
      $loginUserId = auth()->user()->id;
      $history = ClockHistory::where('in_work', true)
        ->where('user_id', $loginUserId)
        ->whereNull('deleted_at')
        ->orderBy('id', 'desc')
        ->first();
      $responseData = [
        'clockHistory' => $history,
      ];
      return response()->json($responseData, 200);
    } catch (Exception $e) {
      return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Show the form for user to pause work.
   */
  public function pauseWork(): JsonResponse
  {
    try {
      $loginUserId = auth()->id();
      $clockHistory = ClockHistory::where('in_work', true)
        ->where('user_id', $loginUserId)
        ->whereNull('deleted_at')
        ->latest('id')
        ->first();
      $responseData = [
        'clockHistory' => $clockHistory,
      ];
      return response()->json($responseData, 200);
    } catch (Exception $e) {
      return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Start the pause.
   */
  public function startPause(Request $request): RedirectResponse
  {
    try {
      ClockPauseHistory::create([
        'clock_history_id' => $request->clock_history_id,
        'pause_start' => now(),
        'reason' => $request->reason,
      ]);
      $history = ClockHistory::find($request->clock_history_id);
      $history->update([
        'in_pause' => true,
        'number_of_pauses' => $history->number_of_pauses + 1,
      ]);
      return redirect()
        ->route('clock-in-out-view')
        ->withSuccess('Paused the work.');
    } catch (Exception $e) {
      return redirect()
        ->route('clock-in-out-view')
        ->withErrors('An error occurred while pausing the work.');
    }
  }

  /**
   * Start the pause.
   */
  public function endPause(Request $request): RedirectResponse
  {
    try {
      $now = now();
      $clockPauseHistory = ClockPauseHistory::find($request->clock_pause_history_id);
      $pauseStart = Carbon::parse($clockPauseHistory->pause_start);
      $pauseStop = $now;
      $difference = $pauseStart->diff($pauseStop);
      $clockPauseHistoryPauseTime = sprintf(
        '%02d:%02d:%02d',
        $difference->h + $difference->days * 24,
        $difference->i,
        $difference->s
      );
      $history = ClockHistory::find($request->clock_history_id);
      $historyPauseTime = $history->pause_time
        ? $this->addTimes($history->pause_time, $clockPauseHistoryPauseTime)
        : $clockPauseHistoryPauseTime;
      $clockPauseHistory->update([
        'pause_stop' => $now,
        'pause_time' => $clockPauseHistoryPauseTime,
      ]);
      $history->update([
        'in_pause' => false,
        'pause_time' => $historyPauseTime,
      ]);
      return redirect()
        ->route('clock-in-out-view')
        ->withSuccess('Resumed the work.');
    } catch (Exception $e) {
      return redirect()
        ->route('clock-in-out-view')
        ->withErrors('An error occurred while finishing the pause.');
    }
  }

  public function timeToSeconds($time)
  {
    list($hours, $minutes, $seconds) = explode(':', $time);
    return $hours * 3600 + $minutes * 60 + $seconds;
  }

  public function secondsToTime($seconds)
  {
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $seconds = $seconds % 60;

    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
  }

  public function addTimes($time1, $time2)
  {
    $seconds1 = $this->timeToSeconds($time1);
    $seconds2 = $this->timeToSeconds($time2);
    $totalSeconds = $seconds1 + $seconds2;
    return $this->secondsToTime($totalSeconds);
  }

  public function subtractTimes($time1, $time2)
  {
    $seconds1 = $this->timeToSeconds($time1);
    $seconds2 = $this->timeToSeconds($time2);
    $totalSeconds = $seconds1 - $seconds2;
    return $this->secondsToTime($totalSeconds);
  }

  public function clockPauseHistory()
  {
    $pauses = ClockPauseHistory::with(['clockHistory.user'])
      ->whereNull('deleted_at')
      ->orderBy('id', 'desc')
      ->get();
    $users = User::whereNull('deleted_at')
      ->where('status', 1)
      ->get();
    return view('content.clock-history.clock-pause-history-index', ['pauses' => $pauses, 'users' => $users]);
  }
}
