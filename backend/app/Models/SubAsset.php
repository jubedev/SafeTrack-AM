<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Muchos a Uno
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubAsset extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'parent_asset_id',
        'internal_code',
        'serial_number',
        'qr_code',
        'name',
        'brand',
        'model',
        'notes'
    ];

    protected $hidden = [
        'serial_number'
    ];

    public function asset():BelongsTo {
        return $this->belongsTo(Asset::class);
    }
}
