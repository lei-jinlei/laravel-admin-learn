<?php

namespace App\Admin\Controllers;

use App\Models\GroupUser;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class GroupUserController extends Controller
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
        return Admin::grid(GroupUser::class, function (Grid $grid) {

            $grid->filter(function ($filter) {
                // 如果过滤器太多，可以使用弹出模态框来显示过滤器.
                // $filter->useModal();

                // 禁用id查询框
                $filter->disableIdFilter();

                $filter->is('gid', '小组id');
            });

            $grid->group()->group_name('组名');
            $grid->user('组员')->display(function ($users) {
                    return "<span class='label label-success'>{$users['name']}</span>";
            });
            $grid->leader('组长')->display(function ($leader) {
                    return $leader ? "<span class='label label-success'>是</span>" : "<span class='label label-danger'>否</span>";
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
        return Admin::form(GroupUser::class, function (Form $form) {
            $form->select('gid','小组名称')->options(function ($gid){
                $api = new ApiController;
                $groups = $api->getGroups();
                return $groups;
            });
            $form->select('admin_user_id', '用户')->options(function ($admin_user_id){
                $api = new ApiController;
                $users = $api->getUsers();
                return $users;
            });
            $form->radio('leader', '是否为组长')->options(
                ['0' => '否', '1' => '是']
            )->default('0');
        });
    }
}
