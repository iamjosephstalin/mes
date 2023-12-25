<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\AccountTypes;
use App\Models\Languages;

class User extends Model
{
  use HasFactory, SoftDeletes;
  public $timestamps = true;
  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $fillable = [
    'name',
    'role',
    'email',
    'mobile',
    'status',
    'image_path',
    'account_type_id',
    'default_language_id',
  ];
  protected $dates = ['deleted_at'];
  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
    'updated_at' => 'datetime:Y-m-d H:i:s',
    'deleted_at' => 'datetime:Y-m-d H:i:s',
  ];
  public function accountType()
  {
    return $this->belongsTo(AccountTypes::class, 'account_type_id');
  }

  public function language()
  {
    return $this->belongsTo(Languages::class, 'default_language_id');
  }
}
