<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['lighthouseReports'];

    public function lighthouseReports(): HasMany
    {
        return $this->hasMany(LighthouseReport::class);
    }

    public function addLighthouseReport($url)
    {
        return $this->lighthouseReports()->create(['url' => $url]);
    }
}
