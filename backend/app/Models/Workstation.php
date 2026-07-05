<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workstation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'location_id',
        'group_id',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }

    public function peripheralAssignments(): HasMany
    {
        return $this->hasMany(PeripheralAssignment::class);
    }
}
