<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location_id',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function workstations(): HasMany
    {
        return $this->hasMany(Workstation::class);
    }

    public function assetAssignments(): HasMany
    {
        return $this->hasMany(AssetAssignment::class);
    }
}
