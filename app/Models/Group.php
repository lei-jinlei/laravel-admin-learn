<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Group extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    public $table = 'group';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_name', 'group_desc',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function users()
    {
        return $this->belongsToMany(AdminUser::class, 'group_user','gid');
    }
}
