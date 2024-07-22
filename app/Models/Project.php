<?php

namespace App\Models;

use Dyrynda\Database\Support\NullableFields;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, NullableFields, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'response_code',
        'response_content_type',
        'response_body',
    ];

    protected array $nullable = [
        'response_body',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    public function getApiUrl(): string
    {
        return $this->getApiUri();
    }

    public function getApiUri(): Uri
    {
        $uri = new Uri(config('app.url'));

        return $uri->withPath($this->getApiPath());
    }

    public function getApiPath(): string
    {
        return "projects/{$this->getKey()}/api";
    }
}
