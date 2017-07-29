<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Inquiry extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    public $table = 'inquiry';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inquiry_sn', 'language', 'name', 'country', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function inquiryType()
    {
        return $this->belongsTo(InquiryType::class, 'type');
    }

    public function countrys()
    {
        return $this->belongsTo(Country::class, 'country');
    }

    public function entryUser()
    {
        return $this->belongsTo(AdminUser::class, 'uid');
    }

    public function handlers()
    {
        return $this->belongsToMany(AdminUser::class, 'user_inquiry','iid');
    }
}
