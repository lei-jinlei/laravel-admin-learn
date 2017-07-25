<?php

namespace App\Admin\Controllers;

use App\Models\Country;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CountryController extends Controller
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
            $content->header('城市管理');
            $content->description('');

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
        return Admin::grid(Country::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->name('城市名称');
            $grid->letter('城市代码');
            $grid->continent('所属大洲')->display(function ($continent) {
                $api = new ApiController;
                $country = $api->country;
                if ($continent) {
                    return $country[$continent];
                }
                return '';
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
        return Admin::form(Country::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('name', '城市名称')->rules('required');
            $form->text('letter', '城市代码')->rules('required');
            $form->select('continent', '所属大洲')
                ->options(function ($id) {
                    $api = new ApiController;
                    $country = $api->country;
                    return $country;
                });
        });
    }


}
