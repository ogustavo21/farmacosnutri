<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class interacciones extends Model
{
    use HasFactory;
    public function farmaco(): BelongsTo
    {
        return $this->belongsTo(farmaco::class, 'idfarmaco', 'id');
    }
}
