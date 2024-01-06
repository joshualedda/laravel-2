<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory;
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id'); // Replace with your table name and foreign key
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'role',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

        // Record audit trail for user creation

        public function getRoleText()
        {
            switch ($this->role) {
                case 0:
                    return 'Staff';
                case 1:
                    return 'Admin';
                case 2:
                    return 'Campus In-charge - NLUC';
                default:
                    return 'Unknown';
            }
        }

        public function isAdminOrCampusInCharge()
        {
            return in_array($this->role, [1, 2]);
        }


}
