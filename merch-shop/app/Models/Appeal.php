<?php

namespace App\Models;

use Database\Factories\AppealFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * App\Models\Appeal
 *
 * @property-read \App\Models\User|null $user
 * @method static Builder|Appeal newModelQuery()
 * @method static Builder|Appeal newQuery()
 * @method static Builder|Appeal query()
 * @mixin \Eloquent
 */
class Appeal extends Model
{
    use HasFactory;

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
