<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeripheralAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'peripheral_type_id',
        'workstation_id',
        'quantity',
        'status',
        'assigned_at',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'assigned_at' => 'datetime',
    ];

    public function peripheralType(): BelongsTo
    {
        return $this->belongsTo(PeripheralType::class);
    }

    public function workstation(): BelongsTo
    {
        return $this->belongsTo(Workstation::class);
    }
}
