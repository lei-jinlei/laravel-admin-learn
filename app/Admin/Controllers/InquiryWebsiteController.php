<?php

namespace App\Admin\Controllers;

use App\Models\InquiryWebsite;


use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class InquiryWebsiteController extends Controller
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

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(InquiryWebsite::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('所属者姓名');
            $grid->value('所管网址');
            $grid->productCat()->name('产品类型');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(InquiryWebsite::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name', '所属者姓名')->rules('required');
            $form->text('value', '所管网址')->rules('required');
            $form->select('type')->options(function ($id) {
                $api = new ApiController;
                $country = $api->productCat();
                return $country;
            });


        });
    }
}
