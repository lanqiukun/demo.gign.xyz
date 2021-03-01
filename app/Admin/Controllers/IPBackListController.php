<?php

namespace App\Admin\Controllers;

use App\IPBackList;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class IPBackListController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'IPBackList';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new IPBackList());

        $grid->column('id', 'ID');
        $grid->column('ip', 'IP');
        $grid->column('created_at', '添加时间');
        // $grid->column('updated_at', '修改时间');

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
        $show = new Show(IPBackList::findOrFail($id));




        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new IPBackList());

        $form->ip('ip', 'IP');
        

        return $form;
    }
}
