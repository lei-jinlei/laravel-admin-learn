<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use Notifiable;
    public $table = 'admin_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'letter',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function groupUser()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    public function entryInquiry()
    {
        return $this->hasOne(Inquiry::class, 'uid');
    }

    public function dealInquiry()
    {
        return $this->belongsToMany(Inquiry::class, 'user_inquiry');
    }
}
