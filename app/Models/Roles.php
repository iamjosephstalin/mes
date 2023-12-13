<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserTypes;

class Roles extends Model
{
  use HasFactory, SoftDeletes;
  protected $table = 'roles';
  protected $primaryKey = 'id';
  protected $fillable = ['name', 'user_type_id', 'created_by', 'updated_by'];

  public function userType()
  {
    return $this->belongsTo(UserTypes::class, 'user_type_id');
  }
}
