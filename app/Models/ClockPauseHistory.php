<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ClockHistory extends Model
{
  use HasFactory, SoftDeletes;
  public $timestamps = true;
  protected $table = 'clock_pause_history';
  protected $primaryKey = 'id';
  protected $fillable = ['clock_history_id', 'pause_start', 'pause_stop', 'pause_time', 'reason', 'comment'];
  protected $dates = ['deleted_at'];
  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
    'updated_at' => 'datetime:Y-m-d H:i:s',
    'deleted_at' => 'datetime:Y-m-d H:i:s',
  ];
}
