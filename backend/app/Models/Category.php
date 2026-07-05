<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function assets():HasMany {
        return $this->hasMany(Asset::class);
    }
}
