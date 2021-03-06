<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductCat;
use App\Models\Group;
use App\Models\Country;
use App\Models\InquiryLanguage;
use App\Models\AdminUser;
use App\Models\InquiryFrom;
use App\Models\InquiryType;

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

    // 询盘状态码
    public $state = array(
        '0'=>'等待处理',
        '1'=>'询盘处理中',
        '2'=>'无效客户',
        '3'=>'已成交',
        '4'=>'未成交',
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

    // 获取所有的用户
    public function getUsers()
    {
        $users = new AdminUser;
        $users = $users->get();
        foreach ($users as $user) {
            $user_arr[$user->id] = $user->name;
        }
        return $user_arr;
    }

    // 获取所有的小组
    public function getGroups()
    {
        $groups = new Group;
        $groups = $groups->get();
        foreach ($groups as $group) {
            $group_arr[$group->id] = $group->group_name;
        }
        return $group_arr;
    }

    public function getLanguage()
    {
        $languages = new InquiryLanguage;
        $languages = $languages->get();
        foreach ($languages as $language) {
            $language_arr[$language->id] = $language->value;
        }
        return $language_arr;
    }

    public function getCountry()
    {
        $countrys = new Country;
        $countrys = $countrys->get();
        foreach ($countrys as $country) {
            $country_arr[$country->id] = $country->name;
        }
        return $country_arr;
    }

    public function getInquiryFrom()
    {
        $froms = new InquiryFrom;
        $froms = $froms->get();
        foreach ($froms as $from) {
            $from_arr[$from->id] = $from->value;
        }
        return $from_arr;
    }

    public function getInquiryType()
    {
        $types = new InquiryType;
        $types = $types->get();
        foreach ($types as $type) {
            $type_arr[$type->id] = $type->name;
        }
        return $type_arr;
    }
}
