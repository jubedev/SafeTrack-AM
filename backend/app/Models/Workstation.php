<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\WorkstationStatus;
use App\Models\Concerns\BelongsToCompany;

class Workstation extends Model
{
    use HasUuids, HasFactory, SoftDeletes, BelongsToCompany;

    protected $fillable = [
        'company_id',
        'operation_name',
        'station_number',
        'building_floor',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => WorkstationStatus::class,
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function assetAssignments(): HasMany
    {
        return $this->hasMany(AssetAssignment::class);
    }
}
