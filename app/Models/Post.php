<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'public_at' => 'timestamp',
    ];

    /**
     * Visible posts only.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeVisible(Builder $query)
    {
        return $query->has('category')
            ->with('category')
            ->whereNotNull('public_at')
            ->whereDate('public_at', '<=', $now = now())
            ->whereTime('public_at', '<=', $now);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
