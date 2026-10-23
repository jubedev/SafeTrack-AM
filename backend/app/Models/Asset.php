<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Concerns\BelongsToCompany;
use App\Enums\AssetStatus;

class Asset extends Model
{
    use HasUuids, HasFactory, SoftDeletes, BelongsToCompany;

    protected $fillable = [
        'company_id',
        'category_id',
        'name',
        'brand',
        'model',
        'serial_number',
        'asset_tag',
        'specifications',
        'status',
        'location',
        'purchase_date',
        'warranty_expiration',
        'cost'
    ];

    protected function casts(): array
    {
        return[
            'status' => AssetStatus::class,
            'specifications' => 'array',
            'purchase_date' => 'date',
            'warranty_expiration' => 'date',
            'cost' => 'decimal:2'
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(AssetAssignment::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(AssetHistory::class);
    }

}
