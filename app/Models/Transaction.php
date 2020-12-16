<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'journal_id',
        'vendor_id',
        'date_at',
        'name',
        'description',
        'type',
        'amount',
        'status',
    ];

    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
