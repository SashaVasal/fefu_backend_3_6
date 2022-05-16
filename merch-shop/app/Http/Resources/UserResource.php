<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'logged_in_at' => $this->logged_in_at,
            'registered_at' => $this->registered_at,
            'github_registered_at' => $this->github_registered_at,
            'github_logged_in_at' => $this->github_logged_in_at,
            'vkontakte_registered_at' => $this->vkontakte_registered_at,
            'vkontakte_logged_in_at' => $this->vkontakte_logged_in_at,
        ];
    }
}
