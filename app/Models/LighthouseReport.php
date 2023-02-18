<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LighthouseReport extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lighthouse_reportable(): MorphTo
    {
        return $this->morphTo();
    }
}
