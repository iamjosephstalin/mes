<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Languages;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
  use HasFactory, SoftDeletes;
  public $timestamps = true;
  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $fillable = [
    'name',
    'role_id',
    'email',
    'mobile',
    'status',
    'image_path',
    'password',
    'default_language_id',
  ];
  protected $dates = ['deleted_at'];
  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
    'updated_at' => 'datetime:Y-m-d H:i:s',
    'deleted_at' => 'datetime:Y-m-d H:i:s',
  ];
  public function role()
  {
    return $this->belongsTo(Role::class, 'role_id');
  }

  public function language()
  {
    return $this->belongsTo(Languages::class, 'default_language_id');
  }
}
