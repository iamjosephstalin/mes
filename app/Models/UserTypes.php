<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
  use HasFactory, SoftDeletes;
  protected $table = 'user_types';
  protected $primaryKey = 'id';
  protected $fillable = ['name'];
}
