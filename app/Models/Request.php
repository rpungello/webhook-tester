<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'project_id',
        'ip_address',
        'path',
        'method',
        'content_type',
        'query_string',
        'body',
        'user_agent',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function headers(): HasMany
    {
        return $this->hasMany(RequestHeader::class);
    }

    public function toList(): array
    {
        $list = [
            [
                'name' => __('Project'),
                'value' => $this->project->name,
            ],
        ];
        foreach ($this->only($this->getListProperties()) as $key => $value) {
            if (! empty($value)) {
                $list[] = [
                    'name' => __("request.$key"),
                    'value' => $this->formatListValue($key, $value),
                ];
            }
        }

        return $list;
    }

    public function getFormattedBody(): string
    {
        if ($this->content_type === 'application/json') {
            $json = json_decode($this->body);
            if (json_last_error() === JSON_ERROR_NONE) {
                return json_encode($json, JSON_PRETTY_PRINT);
            } else {
                return $this->body;
            }
        } else {
            return $this->body;
        }
    }

    protected function getListProperties(): array
    {
        return [
            'ip_address',
            'path',
            'method',
            'content_type',
            'query_string',
            'user_agent',
            'created_at',
        ];
    }

    protected function formatListValue(string $key, mixed $value): string
    {
        if ($key === 'created_at') {
            return $value->format('F j, Y g:ia');
        } else {
            return (string) $value;
        }
    }
}
