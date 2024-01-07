<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ClockPauseHistory;

class ClockHistory extends Model
{
  use HasFactory, SoftDeletes;
  public $timestamps = true;
  protected $table = 'clock_history';
  protected $primaryKey = 'id';
  protected $fillable = [
    'user_id',
    'clock_in',
    'clock_out',
    'working_time',
    'pause_time',
    'number_of_pauses',
    'in_pause',
    'in_work',
    'clock_in_comment',
    'clock_out_comment',
  ];
  protected $dates = ['deleted_at'];
  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
    'updated_at' => 'datetime:Y-m-d H:i:s',
    'deleted_at' => 'datetime:Y-m-d H:i:s',
  ];
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function pause()
  {
    return $this->hasMany(ClockPauseHistory::class, 'clock_history_id');
  }
}
