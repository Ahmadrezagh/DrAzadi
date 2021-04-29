<?php

namespace App\Models;

use App\Notifications\CVENotification;
use App\Services\Permission\Traits\HasPermissions;
use App\Services\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasRoles, HasPermissions;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'profile',
        'type_id',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isSuperAdmin()
    {
        return $this->type_id == 1  ? true : false;
    }
    //  Admin
    //  Get Admins
    public function scopeAdmins($query)
    {
        return $query->where('type_id', 2);
    }

    //  Check is admin
    public function isAdmin()
    {
        return $this->type_id == 2  ? true : false;
    }

    // if user is admin , show admin's role
    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    //
    //  User
    // Get All users
    public function scopeUsers($query)
    {
        return $query->where('type_id', 3);
    }

    // Check is user
    public function isUser()
    {
        return $this->type_id == 3  ? true : false;
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function profile()
    {
        return $this->profile ?? '/uploads/profiles/default/user.png';
    }

    public function default()
    {
        return $this->hasOne(UserDefault::class);
    }

    public function details()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function upgradeRequests()
    {
        return $this->hasMany(UpgradeRequest::class);
    }
    public function activeUpgradeRequest()
    {
        return $this->hasOne(UpgradeRequest::class)->where('status',0);
    }

    public function sendCVEAlertNotification(Score $score)
    {
        if($this->details && $score->score_desc)
            if($this->can($score->score_desc.'_mail'))
                $this->notify(New CVENotification(decrypt($this->details->mail),$score));
    }

    public static function scopeHasDocMail(Builder $query)
    {
        return $query->whereHas('role', function ( $query) {
                $query->whereHas('permission', function ( $_query) {
                    $_query->where('name', '=', 'mail');
                });
        });
    }
}
