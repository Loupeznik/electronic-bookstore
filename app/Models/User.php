<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function parseRole()
    {
        switch($this->role)
        {
            case 0:
                return 'USER';
                break;
            case 1:
                return 'EDITOR';
                break;
            case 2:
                return 'ADMIN';
                break;
        }
    }

    public function hasCustomer()
    {
        if ($this->hasOne(Customer::class)->count() > 0) return true;
        return false;
    }

    public function customerOrders()
    {
        if ($this->hasCustomer())
        {
            return $this->customer->orders;
        }
        return null;
    }

    public function isAdmin()
    {
        if ($this->role > 0) return true;
        return false;
    }
}
