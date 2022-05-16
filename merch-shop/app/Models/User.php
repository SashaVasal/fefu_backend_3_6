<?php

namespace App\Models;

use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public static function createFromRequest($data) : self
    {
        $user = new self();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user;
    }

    public function updateFromRequest($data) : self
    {
        $this->password = Hash::make($data['password']);
        $this->registered_at = Carbon::now();
        $this->logged_in_at = Carbon::now();
        $this->save();
        return $this;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'github_id',
        'vkontakte_id',
        'logged_in_at',
        'registered_at',
        'github_logged_in_at',
        'github_registered_at',
        'vkontakte_logged_in_at',
        'vkontakte_registered_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'github_id',
        'vkontakte_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'logged_in_at'=> 'datetime',
        'registered_at'=> 'datetime',
        'github_logged_in_at'=> 'datetime',
        'github_registered_at'=> 'datetime',
        'vkontakte_logged_in_at'=> 'datetime',
        'vkontakte_registered_at'=> 'datetime',
    ];


}
