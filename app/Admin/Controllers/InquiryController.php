<?php

namespace App\Admin\Controllers;

use App\Models\Inquiry;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class InquiryController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('header');
            $content->description('description');

            $content->body($this->form('deal'));
        });

    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Inquiry::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->column('询盘编号')->display(function () {
                $params = ['id' => $this->id];
                if ($this->state < 1) {
                    return '<a class="text-danger" href="'.url('admin/inquiry/show').'?'.http_build_query($params).'">'.$this->inquiry_sn.'</a>';
                } else {
                    return '<a class="text-success" href="'.url('admin/inquiry/show').'?'.http_build_query($params).'">'.$this->inquiry_sn.'</a>';
                }
            });
            $grid->name('客户名称');
            $grid->email('Email');
            $grid->inquiryType()->name('询盘类型');
            $grid->countrys()->continent('询盘区域')->display(function ($continent) {
                $api =new ApiController;
                $continents = $api->continent;
                if ($continent) {
                    return $continents[$continent];
                } else {
                    return '';
                }
            });
            $grid->handlers('处理人')->display(function ($handlers) {
                $handlers = array_map(function ($handlers) {
                    return "<span class='label label-success'>{$handlers['name']}</span>";
                }, $handlers);

                return join('&nbsp;', $handlers);
            });
            $grid->state('询盘状态')->display(function ($state) {
                $api =new ApiController;
                $states = $api->state;
                return $states[$state];
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        // if ($str == 'deal') {
        //         return Admin::form(Inquiry::class, function (Form $form) {
        //             $form->display('inquiry_sn');
        //             $form->display('language', '询盘语言')->with(function ($value) {
        //                 $api =new ApiController;
        //                 $languages = $api->getLanguage();
        //                 return $languages[$value];
        //             });
        //             $form->display('country', '询盘地区')->with(function ($value) {
        //                 $api =new ApiController;
        //                 $countrys = $api->getCountry();
        //                 return $countrys[$value];
        //             });
        //             $form->display('name', '客户名称');
        //             $form->display('email', 'Email');
        //             $form->display('iphone', '联系方式');
        //             $form->display('other_phone', '其他联系方式');
        //             $form->display('cid', '产品分类')->with(function ($value) {
        //                 $api =new ApiController;
        //                 $products = $api->productCat();
        //                 return $products[$value];
        //             });
        //             $form->display('from', '询盘来源')->with(function ($value) {
        //                 $api =new ApiController;
        //                 $froms = $api->getInquiryFrom();
        //                 return $froms[$value];
        //             });
        //             $form->display('type', '询盘种类')->with(function ($value) {
        //                 $api =new ApiController;
        //                 $types = $api->getInquiryType();
        //                 return $types[$value];
        //             });
        //             $form->display('from_page', '来源地址');
        //             $form->display('from_url', '来源网站');
        //             $form->display('site_manger', '网站管理人');
        //             $form->display('inquiry_time', '询盘时间');
        //             $form->display('content', '询盘详情');
        //         });
        // }
        return Admin::form(Inquiry::class, function (Form $form) {
            $form->select('language', '询盘语种')->options(function () {
                $api =new ApiController;
                return $api->getLanguage();
            });
            $form->select('country', '询盘地区')->options(function () {
                $api =new ApiController;
                return $api->getCountry();
            });
            $form->text('name', '客户名称');
            $form->text('email', 'Email');
            $form->text('phone', '联系方式');
            $form->text('other_phone', '其他联系方式');
            $form->select('cid', '产品分类')->options(function () {
                $api =new ApiController;
                return $api->productCat();
            });
            $form->select('from', '询盘来源')->options(function () {
                $api =new ApiController;
                return $api->getInquiryFrom();
            });
            $form->select('type', '询盘种类')->options(function () {
                $api =new ApiController;
                return $api->getInquiryType();
            });
            $form->text('from_page', '来源地址');
            $form->text('from_url', '来源网站');
            $form->text('site_manger', '网站管理人');
            $form->time('inquiry_time', '询盘时间');
            $form->editor('content', '询盘详情');
        });
    }

    // /**
    //  * 处理询盘
    //  * @return [type] [description]
    //  */
    // protected function deal_form()
    // {
    //     return Admin::form(Inquiry::class, function (Form $form) {
    //         $form->display('inquiry_sn');
    //         $form->display('language', '询盘语言')->with(function ($value) {
    //             $api =new ApiController;
    //             $languages = $api->getLanguage();
    //             return $languages[$value];
    //         });
    //         $form->display('country', '询盘地区')->with(function ($value) {
    //             $api =new ApiController;
    //             $countrys = $api->getCountry();
    //             return $countrys[$value];
    //         });
    //         $form->display('name', '客户名称');
    //         $form->display('email', 'Email');
    //         $form->display('iphone', '联系方式');
    //         $form->display('other_phone', '其他联系方式');
    //         $form->display('cid', '产品分类')->with(function ($value) {
    //             $api =new ApiController;
    //             $products = $api->productCat();
    //             return $products[$value];
    //         });
    //         $form->display('from', '询盘来源')->with(function ($value) {
    //             $api =new ApiController;
    //             $froms = $api->getInquiryFrom();
    //             return $froms[$value];
    //         });
    //         $form->display('type', '询盘种类')->with(function ($value) {
    //             $api =new ApiController;
    //             $types = $api->getInquiryType();
    //             return $types[$value];
    //         });
    //         $form->display('from_page', '来源地址');
    //         $form->display('from_url', '来源网站');
    //         $form->display('site_manger', '网站管理人');
    //         $form->display('inquiry_time', '询盘时间');
    //         $form->display('content', '询盘详情');
    //     });
    // }
}
