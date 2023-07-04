<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationMessage extends Model
{
  use HasFactory;

  public function scopeActived()
  {
    return $this->where('actived', true);
  }

  public function notificationWhatsappDevice(): BelongsTo
  {
    return $this->belongsTo(NotificationWhatsappDevice::class);
  }

  public function notificationWhatsappTemplate(): BelongsTo
  {
    return $this->belongsTo(NotificationWhatsappTemplate::class);
  }

  public function notificationTarget(): BelongsTo
  {
    return $this->belongsTo(NotificationTarget::class);
  }
}
