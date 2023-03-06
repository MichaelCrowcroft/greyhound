<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function lighthouseReports(): MorphMany
    {
        return $this->morphMany(LighthouseReport::class, 'lighthouse_reportable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}