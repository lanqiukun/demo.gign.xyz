<?php

namespace App\Admin\Controllers;

use App\BDOcpc;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BDOcpcController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'BDOcpc';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BDOcpc());
        $grid->actions(function ($actions) {

            // 去掉删除
            $actions->disableDelete();
        
            // 去掉编辑
            $actions->disableEdit();
        
            // 去掉查看
            $actions->disableView();
        });
        // $grid->column('id', __('Id'));
        $grid->column('number', __('转化类型'))->editable();
        $grid->column('token', __('Token'))->editable('textarea');
        $grid->disableCreateButton();
        $grid->disableFilter();
        $grid->disablePagination();

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
        $show = new Show(BDOcpc::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('number', __('Number'));
        $show->field('token', __('Token'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BDOcpc());

        $form->number('number', __('Number'));
        $form->text('token', __('Token'));

        return $form;
    }
}
