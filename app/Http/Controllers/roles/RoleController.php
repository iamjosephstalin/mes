<?php

namespace App\Http\Controllers\roles;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\UserTypes;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
  public function index()
  {
    $roles = Role::with('userType')
      ->whereNull('deleted_at')
      ->get();
    $userTypes = UserTypes::all();
    return view('content.roles.roles-list', ['roles' => $roles, 'userTypes' => $userTypes]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): RedirectResponse
  {
    try {
      $role = Role::where('role', $request->role)
        ->whereNull('deleted_at')
        ->first();
      if ($role) {
        return redirect()
          ->route('roles.index')
          ->withErrors("'" . $request->role . "' role already exists.");
      } else {
        Role::create($request->all());
        return redirect()
          ->route('roles.index')
          ->withSuccess('New role has been added');
      }
    } catch (Exception $e) {
      return redirect()
        ->route('roles.index')
        ->withErrors('An error occurred while adding the role.');
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Role $role): JsonResponse
  {
    try {
      $responseData = [
        'role' => $role,
      ];
      return response()->json($responseData, 200);
    } catch (Exception $e) {
      return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Role $role): RedirectResponse
  {
    try {
      $existingRole = Role::where('role', $request->role)
        ->whereNull('deleted_at')
        ->where('id', '!=', $request->id)
        ->first();
      if ($existingRole) {
        return redirect()
          ->route('roles.index')
          ->withErrors("'" . $request->role . "' role already exists.");
      } else {
        $role->update($request->all());
        return redirect()
          ->route('roles.index')
          ->withSuccess('Role has been updated.');
      }
    } catch (Exception $e) {
      return response()->json(['error' => 'An error occurred'], 500);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Role $role): RedirectResponse
  {
    $role->delete();
    return redirect()
      ->route('roles.index')
      ->withSuccess('Role has been deleted.');
  }
}
