<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AccountTypes extends Model
{
  use HasFactory, SoftDeletes;
  protected $table = 'account_types';
  protected $primaryKey = 'id';
  protected $fillable = ['name'];
}
