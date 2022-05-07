<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\News
 *
 * @method static Builder|News findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static Builder|News newModelQuery()
 * @method static Builder|News newQuery()
 * @method static Builder|News published()
 * @method static Builder|News query()
 * @method static Builder|News withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class News extends Model
{
    use HasFactory, Sluggable;

    protected $dates = ['published_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopePublished(Builder $builder) : Builder
    {
        return $builder->where('published_at', '<', Carbon::now());
    }
}
