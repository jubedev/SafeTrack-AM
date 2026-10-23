<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\Concerns\BelongsToCompany;

class User extends Authenticatable
{
    use HasApiTokens, HasUuids, HasFactory, Notifiable, SoftDeletes, BelongsToCompany;

    protected $fillable = [
        'company_id',
        'document_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'role',
        'status',
        'area',
        'position',
        'avatar_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'role' => UserRole::class,
            'status' => UserStatus::class,
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(AssetAssignment::class, 'employee_id');
    }

    public function assignmentsCreated(): HasMany
    {
        return $this->hasMany(AssetAssignment::class, 'assigned_by_id');
    }

    public function assetHistories(): HasMany
    {
        return $this->hasMany(AssetHistory::class);
    }
}
