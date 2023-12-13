<?php

namespace App\Http\Controllers\roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles as Role;
use Illuminate\Support\Facades\Log;

class Roles extends Controller
{
  public function index()
  {
    $roles = Role::with('userType')
      ->whereNull('deleted_at')
      ->get();
    return view('content.roles.roles-list', compact('roles'));
  }
}
