<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LandingPage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function landingPageSnapshots(): HasMany
    {
        return $this->hasMany(LandingPageSnapshot::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function addLandingPageSnapshot($page): LandingPageSnapshot
    {
        return $this->landingPageSnapshots()->create([
            'page' => $page,
        ]);
    }
}
