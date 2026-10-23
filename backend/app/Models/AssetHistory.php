<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\HistoryAction;
use App\Models\Concerns\BelongsToCompany;

class AssetHistory extends Model
{
    use HasUuids, HasFactory, BelongsToCompany;

    protected $fillable = [
        'company_id',
        'asset_id',
        'user_id',
        'action',
        'details'
    ];

    protected function casts(): array
    {
        return[
            'action' => HistoryAction::class,
        ];
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
