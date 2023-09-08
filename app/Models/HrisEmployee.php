<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HrisEmployee extends Model
{
    use HasFactory;

    public function scopeActived()
    {
        return $this->where('actived', true);
    }

    public function hrisEmployeePresence(): HasMany
  {
    return $this->hasMany(HrisEmployeePresence::class);
  }
}
