<?php

namespace App\Models\Concerns;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait BelongsToCompany
{
    public static function bootBelongsToCompany(): void
    {
        static::addGlobalScope(new CompanyScope);

        static::creating(function (Model $model): void {
            if ($model->company_id) {
                return;
            }

            if (Auth::check()) {
                $model->company_id = Auth::user()->company_id;
            }
        });
    }
}
