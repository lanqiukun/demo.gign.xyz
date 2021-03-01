<?php

namespace App\Admin\Controllers;

use App\Record;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RecordController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '访问记录';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Record());

        $grid->filter(function ($filter) {

            // $filter->equal('platform', '平台');
            $filter->in('platform', '平台')->checkbox([
                // ''   => '全部',
                '百度'    => '百度',
                '搜狗'    => '搜狗',
                '神马'    => '神马',
                '微信公众号' => '微信公众号',
            ]);

            $filter->between('created_at', '访问时间')->datetime();

            $filter->like('url', 'URL');

        });

        $grid->column('id', __('ID'));
        $grid->column('platform', __('平台'));
        $grid->column('keyword', __('关键字'));
        $grid->column('ip', __('IP'));
        $grid->column('location', __('位置'));
        $grid->column('url_token', __('URL标志'));
        $grid->column('url', __('URL'));
        $grid->column('created_at', __('访问时间'));

        $grid->model()->latest();
        
        $grid->paginate(30);
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
        $show = new Show(Record::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('platform', __('Platform'));
        $show->field('keyword', __('Keyword'));
        $show->field('ip', __('Ip'));
        $show->field('url_token', __('Url token'));
        $show->field('url', __('Url'));
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
        $form = new Form(new Record());

        $form->text('platform', __('平台'));
        $form->text('keyword', __('关键字'));
        $form->ip('ip', __('IP'));
        $form->text('url_token', __('URL标志'));
        $form->url('url', __('URL'));

        return $form;
    }
}
