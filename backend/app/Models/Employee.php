<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'department_id',
        'position',
    ];

    public function assetAssignments(): HasMany
    {
        return $this->hasMany(AssetAssignment::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
