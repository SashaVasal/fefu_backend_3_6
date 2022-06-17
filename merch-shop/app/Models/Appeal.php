<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * App\Models\Appeal
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string $message
 * @property int|null $user_id
 * @property-read \App\Models\User|null $user
 * @method static Builder|Appeal newModelQuery()
 * @method static Builder|Appeal newQuery()
 * @method static Builder|Appeal query()
 * @method static Builder|Appeal whereCreatedAt($value)
 * @method static Builder|Appeal whereEmail($value)
 * @method static Builder|Appeal whereId($value)
 * @method static Builder|Appeal whereMessage($value)
 * @method static Builder|Appeal whereName($value)
 * @method static Builder|Appeal wherePhone($value)
 * @method static Builder|Appeal whereUpdatedAt($value)
 * @method static Builder|Appeal whereUserId($value)
 * @mixin \Eloquent
 */
class Appeal extends Model
{
    use HasFactory;

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
