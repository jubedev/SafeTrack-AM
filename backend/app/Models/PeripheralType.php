<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PeripheralType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'total_stock',
        'available_stock',
    ];

    protected $casts = [
        'total_stock' => 'integer',
        'available_stock' => 'integer',
    ];

    public function peripheralAssignments(): HasMany
    {
        return $this->hasMany(PeripheralAssignment::class);
    }
}
