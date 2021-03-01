<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('ID'));
        $grid->column('avatar', __('头像'));
        $grid->column('come_from', __('来源'));
        $grid->column('phone', __('电话'));
        $grid->column('status', __('状态')) -> using([
            0 => '正常',
            1 => '禁止'
        ]);;
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('上次登录'));
        // $grid->column('deleted_at', __('Deleted at'));

        $grid->model()->latest();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('avatar', __('Avatar'));
        $show->field('come_from', __('Come from'));
        $show->field('phone', __('Phone'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->image('avatar', __('头像'));
        $form->switch('come_from', __('来源'));
        $form->mobile('phone', __('电话'));
        $form->switch('status', __('状态'));

        return $form;
    }
}
