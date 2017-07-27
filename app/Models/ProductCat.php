<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class ProductCat extends Authenticatable
{
    use Notifiable, ModelTree, AdminBuilder;
    public $timestamps = false;
    public $table = 'product_cat';

   public function __construct(array $attributes = [])
   {
       parent::__construct($attributes);

       $this->setParentColumn('pid');
       $this->setOrderColumn('order');
       $this->setTitleColumn('name');
   }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'pid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function inquiryWebsite()
    {
        return $this->hasMany(InquiryWebsite::class, 'type');
    }


}
