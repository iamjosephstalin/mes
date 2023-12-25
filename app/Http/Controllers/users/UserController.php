<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AccountTypes;
use App\Models\Languages;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
  public function index()
  {
    $users = User::with('accountType')
      ->with('language')
      ->whereNull('deleted_at')
      ->get();
    $accountTypes = AccountTypes::all();
    $languages = Languages::all();
    return view('content.users.users-list', [
      'users' => $users,
      'accountTypes' => $accountTypes,
      'languages' => $languages,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): RedirectResponse
  {
    try {
      $existingUser = User::whereIn('email', [$request->email])
        ->orWhere('mobile', $request->mobile)
        ->whereNull('deleted_at')
        ->first();

      if ($existingUser) {
        $identifier = $existingUser->email === $request->email ? 'Email' : 'Mobile number';
        $errorMessage = "{$identifier} '{$existingUser->{$identifier === 'Email'
          ? 'email'
          : 'mobile'}}' already exists.";

        return redirect()
          ->route('users.index')
          ->withErrors($errorMessage);
      }
      User::create($request->all());
      return redirect()
        ->route('users.index')
        ->withSuccess('New user has been added');
    } catch (Exception $e) {
      return redirect()
        ->route('users.index')
        ->withErrors('An error occurred while adding the user.');
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user): JsonResponse
  {
    try {
      $responseData = [
        'user' => $user,
      ];
      return response()->json($responseData, 200);
    } catch (Exception $e) {
      return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user): RedirectResponse
  {
    try {
      $existingUser = User::where(function ($query) use ($request) {
        $query->where('email', $request->email)->orWhere('mobile', $request->mobile);
      })
        ->whereNull('deleted_at')
        ->where('id', '!=', $request->id)
        ->first();
      if ($existingUser) {
        $identifier = $existingUser->email === $request->email ? 'Email' : 'Mobile number';
        $errorMessage = "{$identifier} '{$existingUser->{$identifier === 'Email'
          ? 'email'
          : 'mobile'}}' already exists.";

        return redirect()
          ->route('users.index')
          ->withErrors($errorMessage);
      } else {
        $user->update($request->all());
        return redirect()
          ->route('users.index')
          ->withSuccess('User has been updated.');
      }
    } catch (Exception $e) {
      return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user): RedirectResponse
  {
    $user->delete();
    return redirect()
      ->route('users.index')
      ->withSuccess('User has been deleted.');
  }
}
