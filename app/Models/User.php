<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use URL;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'login_type',
        'profile',
        'token',
        'social_id',
    ];

    const Admin = 1;
    const User = 2;
    const Company = 3;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $searchable = [
        'email',
        'name',
        'first_name',
        'last_name',
        'username',
        'phone'
    ];

    public function scopeSearching($q)
    {
        if (request('search')) {
            foreach ($this->searchable as $key => $value) {
                $q->orwhere($value, 'LIKE', '%' . request('search') . '%');
            }
        }
        return $q;
    }

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

    /**
     * The event map for the model.
     *
     * @var array<string, string>
     */
    // protected $dispatchesEvents = [
    //     'created' => UserSaved::class
    // ];

    public function menus(): HasOne
    {
        return $this->hasOne(UserMenu::class, 'user_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function confirmMembers(): HasMany
    {
        return $this->hasMany(Member::class)->where(["status" => "0"]);
    }

    public function profile()
    {
        if (strlen($this->profile) < 20) {
            $this->profile = URL::asset('/images/user/' . $this->profile);
        } else if ($this->profile == null) {
            $this->profile = URL::asset('/images/user/default.png');
        }
        return $this->profile;
    }

    public function is_user()
    {
        return $this->user_type == User::User ? true : false;
    }
    public function is_admin()
    {
        return $this->user_type == User::Admin ? true : false;
    }
    public function is_company()
    {
        return $this->user_type == User::Company ? true : false;
    }

    public function webpages()
    {
        return $this->hasMany(Webpage::class);
    }

    public function businessProfile()
    {
        return $this->belongsTo(BusinessProfile::class);
    }
}
