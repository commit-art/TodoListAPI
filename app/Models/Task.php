<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'title',
        'description',
        'priority',
        'status',
        'completed_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Subtasks associated with task.
     *
     */
    public function subtasks(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function scopeHasActiveSubtasks(): bool
    {
        return (bool)$this->hasMany(static::class, 'parent_id')
            ->whereNull('completed_at')->count();
    }
}
