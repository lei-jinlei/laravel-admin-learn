<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GroupUser extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    public $table = 'group_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gid', 'uid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'gid');
    }

    public function user()
    {
        
    }
}
