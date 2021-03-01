<?php

namespace App\Admin\Controllers;

use App\Code;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CodeController extends AdminController
{

    
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Code';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Code());


        
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();

            $filter->column(1 / 2, function ($filter) {
                $filter->like('phone', '手机号');
                $filter->like('ip', 'IP');
            });

            $filter->column(1 / 2, function ($filter) {
                $filter->between('created_at', '时间范围')->datetime();
            });


        });


        // $grid->column('id', __('Id'));
        $grid->column('phone', __('手机号'))->filter('like');
        $grid->column('code', __('验证码'));
        $grid->column('created_at', __('发送时间'));
        $grid->column('used_at', __('使用时间'));
        $grid->column('ip', __('IP'));
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
        $show = new Show(Code::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('phone', __('Phone'));
        $show->field('code', __('Code'));
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
        $form = new Form(new Code());

        $form->mobile('phone', __('Phone'));
        $form->number('code', __('Code'));
        $form->ip('ip', __('IP'));

        return $form;
    }
}
