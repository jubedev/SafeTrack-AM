<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'internal_code',
        'serial_number',
        'qr_code',
        'brand',
        'model',
        'category_id',
        'location_id',
        'workstation_id',
        'status',
        'purchase_date',
        'warranty_expiration',
        'notes',
        'specifications',
    ];

    protected $hidden = [
        'serial_number',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'warranty_expiration' => 'date',
        'specifications' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function workstation(): BelongsTo
    {
        return $this->belongsTo(Workstation::class);
    }

    /**
     * Operational area derived from the assigned workstation.
     * When workstation_id is null (warehouse stock), no group applies.
     */
    public function assignedGroup(): ?Group
    {
        return $this->workstation?->group;
    }

    public function assetAssignments(): HasMany
    {
        return $this->hasMany(AssetAssignment::class);
    }
}
