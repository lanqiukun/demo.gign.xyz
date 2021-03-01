<?php

namespace App\Admin\Controllers;

use App\Result;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ResultController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Result';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Result());
        $grid->filter(function($filter){
            $filter->disableIdFilter();

            $filter->between('created_at', '查询时间')->datetime();


            $filter->like('order_no', '订单号');

            $filter->equal('order.order_type', '项目类型:')->radio([
                1 => '出险记录查询',
                2 => '维保记录查询',
                3 => 'VIN车架号查车辆',
                5 => '交强险查询',
                6 => '车辆年检状态查询',
                9 => '车牌号查车辆',
                10 => '驾驶证扣分',
                11 => '违章扣分',
            ]);
        });
        $grid->column('id', __('ID'));
        $grid->column('order_no', __('订单号'))->editable()->copyable();
        $grid->column('created_at', __('查询时间'));

        $grid->column('order.order_type', __('项目'))->using([
            1 => '<span style="padding: .1em .5em .1em;background-color:  cornflowerblue; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">出险记录查询</span>',
            2 => '<span style="padding: .1em .5em .1em;background-color:  crimson; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">维保记录查询</span>',
            3 => '<span style="padding: .1em .5em .1em;background-color:  darkgoldenrod; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">VIN车架号查车辆</span>',
            5 => '<span style="padding: .1em .5em .1em;background-color:  darkorchid; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">交强险查询</span>',
            6 => '<span style="padding: .1em .5em .1em;background-color:  deepskyblue; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">车辆年检状态查询</span>',
            9 => '<span style="padding: .1em .5em .1em;background-color:  darkviolet; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">车牌号查车辆</span>',
            10 => '<span style="padding: .1em .5em .1em;background-color: coral; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">驾驶证扣分</span>',
            11 => '<span style="padding: .1em .5em .1em;background-color: chartreuse; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">违章扣分</span>',
        ])->sortable();

        $grid->column('response', __('返回响应'))->width(1000);
        // $grid->column('updated_at', __('Updated at'));
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
        $show = new Show(Result::findOrFail($id));

        $show->response('返回响应')->json();

        // $show->field('id', __('Id'));
        // $show->field('order_no', __('Order no'));
        // $show->field('respone', __('Respone'));
        // $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));
        // $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Result());
        $form->json('response', '返回响应');
        $form->text('order_no', __('订单号'));
        

        return $form;
    }
}
