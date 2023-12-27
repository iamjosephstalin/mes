<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Languages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  public function index()
  {
    $users = User::with('role')
      ->with('language')
      ->whereNull('deleted_at')
      ->get();
    $roles = Role::whereNull('deleted_at')->get();
    $languages = Languages::all();
    return view('content.users.users-list', [
      'users' => $users,
      'roles' => $roles,
      'languages' => $languages,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): RedirectResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        'profile' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      ]);
      if ($validator->fails()) {
        return redirect()
          ->back()
          ->withErrors($validator)
          ->withInput();
      }
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
      if ($request->hasFile('profile')) {
        $now = Carbon::now();
        $filename = $now->format('YmdHis') . '_profile.' . $request->file('profile')->extension();
        $imagePath = $request->file('profile')->storeAs('public/profiles', $filename);
        $request->merge(['image_path' => 'profiles/' . $filename]);
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
        if ($request->hasFile('profile')) {
          // Delete existing image if any:
          if ($user->image_path) {
            Storage::delete('public/' . $user->image_path);
          }
          $now = Carbon::now();
          $filename = $now->format('YmdHis') . '_profile.' . $request->file('profile')->extension();
          $imagePath = $request->file('profile')->storeAs('public/profiles', $filename);
          $request->merge(['image_path' => 'profiles/' . $filename]);
        }

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
