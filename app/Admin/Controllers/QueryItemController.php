<?php

namespace App\Admin\Controllers;

use App\QueryItem;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Widget;

class QueryItemController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QueryItem';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QueryItem());

        $grid->column('id', __('ID'));
        $grid->column('title', __('标题'))->width(160);
        $grid->column('page', __('页面路径'))->width(160);
        $grid->column('argc', __('所需参数'))->display(function ($argc) {
            $argcs = explode(' ', $argc);
            $argcs_show = '';

            foreach ($argcs as $item)
                $argcs_show .= $item . '<br>';
        
            return $argcs_show;
        })->width(80);
        // ->editable('textarea')->width(160);
        // $grid->column('argc', __('所需参数'))->width(270);
        $grid->column('example', __('参数示例值'))->display(function ($example) {
            $examples = explode(' ', $example);
            $examples_show = '';

            foreach ($examples as $item)
                $examples_show .= $item . '<br>';
        
            return $examples_show;
        })->width(200);
        
        
        $grid->column('origin_price', __('原价'))->editable();
        $grid->column('price', __('价格'))->editable();

        $grid->column('service', __('服务名称'))->help('诚数科技的业务服务名称')->width(160);

        
        // $grid->column('fee', __('调用费'))->help('有些接口每次调用的费用取决于具体车型！')->width(100);
        // $grid->column('count', __('调用次数'))->width(100);
        $grid->column('consume', __('消费'))->display(function () {
            return $this->fee * $this->count;
            return 0;
        })->width(100);
        $grid->column('pay_title', __('支付标题'))->editable()->help('当用户支付时显示的标题');

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
        $show = new Show(QueryItem::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('price', __('Price'));
        $show->field('pay_title', __('Pay title'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new QueryItem());

        $form->text('title', __('项目标题'));
        $form->text('page', __('页面路径'));
        $form->decimal('origin_price', __('原价'));
        $form->text('argc', __('所需参数'));
        $form->text('example', __('参数示例值'));

        $form->decimal('price', __('价格'));
        $form->text('service', __('服务名称'));
        $form->text('fee', __('调用费'));
        $form->text('pay_title', __('项目支付标题'));

        return $form;
    }
}
