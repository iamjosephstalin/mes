<?php

namespace App\Http\Controllers\roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles as Role;
use App\Models\UserTypes;
use Illuminate\Support\Facades\Log;

class Roles extends Controller
{
  public function index()
  {
    $roles = Role::with('userType')
      ->whereNull('deleted_at')
      ->get();
    $userTypes = UserTypes::all();
    return view('content.roles.roles-list', ['roles' => $roles, 'userTypes' => $userTypes]);
  }

  public function save(Request $request)
  {
  }

  public function edit(Request $request)
  {
  }

  public function update(Request $request)
  {
  }

  public function delete(Request $request)
  {
  }
}
