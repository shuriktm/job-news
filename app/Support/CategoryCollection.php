<?php

namespace App\Support;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryCollection extends Collection
{
    /**
     * Prepare options collection with id / title pairs.
     *
     * @return \Illuminate\Support\Collection<TMapWithKeysKey, TMapWithKeysValue>|static<TMapWithKeysKey, TMapWithKeysValue>
     */
    public function options()
    {
        return $this->mapWithKeys(fn(Category $model) => [$model->id => $model->title]);
    }
}
