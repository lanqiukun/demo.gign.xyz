<?php

namespace App\Admin\Controllers;

use App\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Pay\Refund;
use App\Admin\Actions\Pay\Query;
use App\Admin\Actions\Pay\Status;
use App\Admin\Actions\Feedback;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\DB;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */

    protected function grid()
    {

        $grid = new Grid(new Order());

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->between('created_at', '下单时间')->datetime();
                $filter->between('paid_at', '支付时间')->datetime();
                $filter->like('phone', '手机号');
                $filter->like('order_no', '商户单号');
                $filter->like('trade_no', '交易单号');
                $filter->like('vin', 'vin车架号');
            });


            $filter->column(1 / 2, function ($filter) {
                $filter->equal('order_type', '项目类型:')->radio([
                    1 => '出险记录查询',
                    2 => '维保记录查询',
                    3 => 'VIN车架号查车辆',
                    5 => '交强险查询',
                    6 => '车辆年检状态查询',
                    9 => '车牌号查车辆',
                    10 => '驾驶证扣分',
                    11 => '违章扣分',
                ]);
                $filter->equal('payment_status', '支付状态:')->radio([
                    0 => '未支付',
                    1 => '已支付',
                ]);
                $filter->equal('refund_status', __('退款状态'))->radio([
                    0 => '未申请',
                    1 => '已申请',
                    2 => '已退款',
                    3 => '已拒绝'
                ]);

                $filter->equal('query_result_id', __('数据查询'))->radio([
                    0 => '未查询'
                ]);

                $filter->like('bd_url', 'URL');
            });
        });


        // $grid->header(function ($query) {
        //     // $query->column(1 / 2, function ($query) {
        //         $paid = 100;
        //         $unpaid = 120;


        //         $doughnut = view('admin.payment', compact(['paid', 'unpaid']));
                
        //         return new Box('支付比例', $doughnut);

        // });

        $grid->actions(function ($actions) {

            // 去掉删除
            $actions->disableDelete();

            // 去点详情 
            $actions->disableView();

            // 去掉编辑
            $actions->disableEdit();


            $actions->add(new Refund);
            $actions->add(new Status);
            $actions->add(new Query);
            $actions->add(new Feedback);
        });

        // $grid->column('id', __('ID'));
        $grid->column('order_no', __('商户单号'))->copyable()->filter('like');

        $grid->column('trade_no', '交易单号')->copyable()->filter('like');

        $grid->column('phone', __('电话'))->filter('like');
        // $grid->column('price', __('支付金额'));
        $grid->column('pay_type', __('支付方式'))->using([
            0 => '支付宝',
            1 => '微信',
            2 => '支付宝',
        ]);
        $grid->column('payment_status', __('支付状态'))->using([
            0 => "未支付",
            1 => "已支付"
        ])->dot([
            0 => 'warning',
            1 => 'success'
        ]);



        $grid->column('query_result_id', __('数据查询'))->using([
            0 => '未查询'
        ], $default = '已查询')->dot([
            0 => 'warning',
        ], $default = 'success')->sortable();
        $grid->column('created_at', __('创建时间'))->sortable();

        $grid->column('paid_at', __('支付时间'))->sortable();



        $grid->column('order_type', __('项目'))->using([
            1 => '<span style="padding: .1em .5em .1em;background-color:  cornflowerblue; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">出险记录查询</span>',
            2 => '<span style="padding: .1em .5em .1em;background-color:  crimson; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">维保记录查询</span>',
            3 => '<span style="padding: .1em .5em .1em;background-color:  darkgoldenrod; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">VIN车架号查车辆</span>',
            5 => '<span style="padding: .1em .5em .1em;background-color:  darkorchid; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">交强险查询</span>',
            6 => '<span style="padding: .1em .5em .1em;background-color:  deepskyblue; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">车辆年检状态查询</span>',
            9 => '<span style="padding: .1em .5em .1em;background-color:  darkviolet; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">车牌号查车辆</span>',
            10 => '<span style="padding: .1em .5em .1em;background-color: coral; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">驾驶证扣分</span>',
            11 => '<span style="padding: .1em .5em .1em;background-color: chartreuse; color: snow; font-weight: bold; font-size: 1.4rem; border-radius: 0.5rem">违章扣分</span>',
        ])->sortable();

        // $grid->column('location', __('省份'));
        $grid->column('bd_url', __('URL'))->width(240)->filter('like');
        // $grid->column('keyword', __('关键字'));
        // $grid->column('updated_at', __('Updated at'));
        // $grid->column('deleted_at', __('Deleted at'));

        // $grid->model()->orderBy('created_at', 'desc');
        // $grid->column('预览')->modal('查询结果预览', function ($model) {
        //     return new Result($model->order_no);
        // });
        
        $grid->column('feedback_bd', __('回传'))->bool([
            0 => false,
            1 => true
        ]);

        $grid->column('link', '预览')->display(function ($link) {
            return '<a target="__blank" href=' . $link . '>预览</a>';
        });

        $grid->column('show', '查看')->display(function ($link) {
            return '<a target="__blank" href=' . $link . '>查看</a>';
        });

        $grid->column('price', '总额')->totalRow();
        $grid->column('refund_status', __('退款状态'))->using([
            0 => '未申请',
            1 => '已申请',
            2 => '已退款',
            3 => '已拒绝'
        ])->dot([
            0 => 'default',
            1 => 'warning',
            2 => 'success',
            3 => 'danger'
        ]);
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
        $show = new Show(Order::findOrFail($id));

        // $show->field('id', __('ID'));
        $show->field('order_no', __('订单号'));
        $show->field('phone', __('电话'));
        $show->field('jie', __('价格'));
        // $show->field('pay_type', __('Payment method'));
        // $show->field('payment_status', __('Payment status'));
        // $show->field('paid_at', __('Paid at'));
        // $show->field('refund_status', __('Refund status'));
        // $show->field('order_type', __('Order type'));
        // $show->field('location', __('Location'));
        // $show->field('url_token', __('Url token'));
        // $show->field('keyword', __('Keyword'));
        // $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('更新时间'));
        // $show->field('deleted_at', __('Deleted at'));
        $show->field('vin', __('车架号'));
        $show->field('chepai', __('车牌号'));
        $show->field('plate_type', __('车辆类型'));
        $show->field('jsz', __('驾驶证'));
        $show->field('file_num', __('档案编号'));
        $show->field('engine_no', __('发动机号'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());

        $form->text('order_no', __('商户单号'));
        $form->mobile('phone', __('电话'));
        $form->number('price', __('价格'));
        $form->switch('pay_type', __('支付方式'));
        $form->switch('payment_status', __('支付状态'));
        $form->datetime('paid_at', __('支付时间'))->default(date('Y-m-d H:i:s'));
        $form->switch('refund_status', __('退款状态'));
        $form->text('order_type', __('项目'));
        $form->text('location', __('省份'));
        $form->text('url_token', __('URL标志'));
        $form->text('keyword', __('关键字'));

        return $form;
    }
}
