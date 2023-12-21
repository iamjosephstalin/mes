<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
  use HasFactory, SoftDeletes;
  public $timestamps = true;
  protected $table = 'api_keys';
  protected $primaryKey = 'id';
  protected $fillable = ['api_key', 'status', 'products', 'orders', 'files', 'clients'];
  protected $dates = ['deleted_at'];
  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
    'updated_at' => 'datetime:Y-m-d H:i:s',
    'deleted_at' => 'datetime:Y-m-d H:i:s',
  ];
}
