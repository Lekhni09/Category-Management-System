<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Events\UserSaved;


class User extends Model {
    use HasApiTokens, HasFactory, Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'prefixname',
        'name',
        'email',
        'mobile',
        'address',
        'password',
    ];

    /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function booted()
    {
    static::saved(function ($user) {
        UserSaved::dispatch($user); 
    });
    }

    /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute( $value ) {
        return ucwords( strtolower( $value ) );
    }

    public function details() {
        return $this->hasMany( Detail::class );
    }
}
