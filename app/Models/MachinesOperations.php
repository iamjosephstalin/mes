<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachinesOperations extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'machines_operations';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'active',
        'end_machine',
        'work_hour_price',
        'currency_id',
        'no_of_shifts',
        'hours_per_pay',
        'notes'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
    
}
