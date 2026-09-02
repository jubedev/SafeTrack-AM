<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetAssignment extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'asset_id',
        'employee_id',
        'workstation_id',
        'assigned_by_id',
        'status',
        'notes_on_delivery',
        'notes_on_return',
        'signature_path',
        'assigned_at',
        'returned_at'
    ];

    protected function casts(): array
    {
        return[
            'assigned_at' => 'datetime',
            'returned_at' => 'datetime'
        ];
    }

    public function workstation(): BelongsTo
    {
        return $this->belongsTo(Workstation::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

}
