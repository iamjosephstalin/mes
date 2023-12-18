<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserTypes;

class Role extends Model
{
  use HasFactory, SoftDeletes;
  public $timestamps = true;
  protected $table = 'roles';
  protected $primaryKey = 'id';
  protected $fillable = ['role', 'user_type_id'];
  protected $dates = ['deleted_at'];
  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
    'updated_at' => 'datetime:Y-m-d H:i:s',
    'deleted_at' => 'datetime:Y-m-d H:i:s',
  ];
  public function userType()
  {
    return $this->belongsTo(UserTypes::class, 'user_type_id');
  }
}
