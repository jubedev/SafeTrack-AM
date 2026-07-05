<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'description',
        'address',
    ];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function workstations(): HasMany
    {
        return $this->hasMany(Workstation::class);
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }
}
