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
     * @inheritdoc
     */
    protected $fillable = [
        'category_id',
        'content',
        'publish_at',
        'slug',
        'title',
    ];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'publish_at' => 'datetime',
    ];

    /**
     * @inheritdoc
     */
    protected $dates = [
        'publish_at',
        'deleted_at',
    ];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Posts to manage in admin.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeManage(Builder $query)
    {
        return $query->with('category')
            ->whereNotNull('publish_at')
            ->orderByDesc('publish_at');
    }

    /**
     * Published posts only.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->with('category')
            ->whereNotNull('publish_at')
            ->whereDate('publish_at', '<=', $now = now())
            ->whereTime('publish_at', '<=', $now)
            ->orderByDesc('publish_at');
    }
}
