<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPremium()
    {
        return $this->subscription && $this->subscription->plan_name === 'premium' && $this->subscription->status === 'active';
    }

    public function isFree()
    {
        return !$this->isPremium();
    }

    public function canCreateInvitation()
    {
        if ($this->isAdmin()) return true;
        
        $limit = $this->isPremium() ? 999 : 1;
        return $this->invitations()->count() < $limit;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        static::created(function ($user) {
            if (!$user->subscription) {
                $user->subscription()->create([
                    'plan_name' => 'free',
                    'status' => 'active'
                ]);
            }
        });
    }

}
