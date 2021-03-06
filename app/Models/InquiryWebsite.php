<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class InquiryWebsite extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    public $table = 'inquiry_website';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function productCat()
    {
        return $this->belongsTo(ProductCat::class, 'type');
    }
}
