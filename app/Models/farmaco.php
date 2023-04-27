<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class farmaco extends Model
{
    use HasFactory;

    public function bibliografia(): BelongsToMany
    {
        return $this->BelongsToMany(bibliografia::class, 'farmacobiblios');
    }

    public function grupofarmaco(): BelongsTo
    {
        return $this->belongsTo(grupofarmaco::class, 'id_grupo', 'id');
    }
    
    public function interaciones(): HasMany
    {
        return $this->hasMany(interaciones::class);
    }


}
