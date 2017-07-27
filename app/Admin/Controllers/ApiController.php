<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductCat;

class ApiController extends Controller
{
    // 各大洲数组数据
    public $continent = array(
        '0' => '未定义',
        '1'=>'东亚',
        '2'=>'东南亚',
        '3'=>'南亚',
        '4'=>'中亚',
        '5'=>'西亚',
        '6'=>'北非',
        '7'=>'撒哈拉以南的非洲',
        '8'=>'东欧',
        '9'=>'西欧',
        '10'=>'北欧',
        '11'=>'中欧',
        '12'=>'南欧',
        '13'=>'北美',
        '14'=>'拉丁美洲',
        '15'=>'中东',
        '16'=>'大洋洲',
    );

    // 获取产品和id数组列表
    public function productCat()
    {
        $product_cat = new ProductCat;
        $cats = $product_cat->get();
        $cat_arr = array('0'=>'顶级分类');
        foreach ($cats as $cat) {
            $cat_arr[$cat->id] = $cat->name;
        }
        return $cat_arr;
    }
}
