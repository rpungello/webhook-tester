<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestHeader extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'request_id',
        'name',
        'value',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
}
