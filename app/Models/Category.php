<?php

namespace App\Models;

use App\Support\CategoryCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'slug',
        'title',
    ];

    /**
     * @inheritdoc
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * @inheritdoc
     */
    public function newCollection(array $models = [])
    {
        return new CategoryCollection($models);
    }

    /**
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Categories to manage in admin.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeManage(Builder $query)
    {
        return $query->orderBy('title');
    }

    /**
     * Categories with posts.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopePublic(Builder $query)
    {
        return $query->withWhereHas('posts', function ($query) {
            $query->whereNull('deleted_at')
                ->whereDate('publish_at', '<=', $now = now())
                ->whereTime('publish_at', '<=', $now);
        })->orderBy('title');
    }
}
