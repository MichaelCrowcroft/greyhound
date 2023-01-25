<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LighthouseReport extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['lighthouseReportData'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function lighthouseReportData(): HasMany
    {
        return $this->hasMany(LighthouseReportData::class);
    }
}
