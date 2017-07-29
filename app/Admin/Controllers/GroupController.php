<?php

namespace App\Admin\Controllers;

use App\Models\Group;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class GroupController extends Controller
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
        return Admin::grid(Group::class, function (Grid $grid) {
            $grid->group_name('小组名称')->sortable();
            $grid->group_desc('小组详情');
            $grid->users()->display(function ($users) {
                $users = array_map(function ($users) {
                    return "<span class='label label-success'>{$users['name']}</span>";
                }, $users);

                return join('&nbsp;', $users);
            });
            $grid->id('小组管理')->display(function ($id) {
                $params = ['gid' => $id];
                return '<a class="btn btn-sm btn-primary" href="'.url('admin/group_user').'?'.http_build_query($params).'">'.'小组成员</a>';
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
        return Admin::form(Group::class, function (Form $form) {
            $form->text('group_name', '小组名称')->rules('required');
            $form->textarea('group_desc', '小组详情');
        });
    }
}
