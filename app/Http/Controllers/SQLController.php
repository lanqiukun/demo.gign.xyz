<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SQLController extends Controller
{
    //
    static $all_total_sql = <<<EOT
SELECT DAY(temp.last14day) as date, ifnull(sum(case when orders.payment_status = 1 then orders.price else 0 end), 0) as 'sum'
FROM (
            select curdate() - INTERVAL (last14.num14) DAY as last14day 	from (	select 	0 	as 	num14	
            union all select 1             union all select 2             union all select 3             union all select 4             union all select 5             
            union all select 6             union all select 7             union all select 8             union all select 9	            union all select 10
            union all select 11            union all select 12            union all select 13            union all select 14            ) as last14
) as temp
left join orders on date_format(orders.created_at, '%Y-%m-%d') = temp.last14day group by temp.last14day order by temp.last14day asc limit 15;
EOT;

    static $all_refund_sql = <<<EOT
SELECT DAY(temp.last14day) as date, ifnull(sum(case when orders.refund_status = 2 then orders.price else 0 end), 0) as 'sum'
FROM (
            select curdate() - INTERVAL (last14.num14) DAY as last14day		from (	select 	0 	as 	num14	
            union all select 1             union all select 2             union all select 3             union all select 4             union all select 5             
            union all select 6             union all select 7             union all select 8             union all select 9	            union all select 10
            union all select 11            union all select 12            union all select 13            union all select 14            ) as last14
) as temp
left join orders on date_format(orders.created_at, '%Y-%m-%d') = temp.last14day group by temp.last14day order by temp.last14day asc limit 15;
EOT;


    static $item_total_sql = <<<EOT
SELECT DAY(temp.last14day) as date, ifnull(sum(case when orders.payment_status = 1 and orders.order_type = ? then orders.price else 0 end), 0) as 'sum'
FROM (
            select curdate() - INTERVAL (last14.num14) DAY as last14day 	from (	select 	0 	as 	num14	
            union all select 1             union all select 2             union all select 3             union all select 4             union all select 5             
            union all select 6             union all select 7             union all select 8             union all select 9	            union all select 10
            union all select 11            union all select 12            union all select 13            union all select 14            ) as last14
) as temp
left join orders on date_format(orders.created_at, '%Y-%m-%d') = temp.last14day group by temp.last14day order by temp.last14day asc limit 15;
EOT;

    static $item_refund_sql = <<<EOT
SELECT DAY(temp.last14day) as date, ifnull(sum(case when orders.refund_status = 2 and orders.order_type = ? then orders.price else 0 end), 0) as 'sum'
FROM (
            select curdate() - INTERVAL (last14.num14) DAY as last14day		from (	select 	0 	as 	num14	
            union all select 1             union all select 2             union all select 3             union all select 4             union all select 5             
            union all select 6             union all select 7             union all select 8             union all select 9	            union all select 10
            union all select 11            union all select 12            union all select 13            union all select 14            ) as last14
) as temp
left join orders on date_format(orders.created_at, '%Y-%m-%d') = temp.last14day group by temp.last14day order by temp.last14day asc limit 15;
EOT;


    static $all_user_sql = <<<EOT
SELECT DAY(temp.last14day) as date, ifnull(count(used_at), 0) as 'sum'
FROM (
            select curdate() - INTERVAL (last14.num14) DAY as last14day		from (	select 	0 	as 	num14	
            union all select 1             union all select 2             union all select 3             union all select 4             union all select 5             
            union all select 6             union all select 7             union all select 8             union all select 9	            union all select 10
            union all select 11            union all select 12            union all select 13            union all select 14            ) as last14
) as temp
left join codes on date_format(codes.created_at, '%Y-%m-%d') = temp.last14day group by temp.last14day order by temp.last14day asc limit 15;
EOT;

static $all_msg_sql = <<<EOT
SELECT DAY(temp.last14day) as date, ifnull(count(created_at), 0) as 'sum'
FROM (
            select curdate() - INTERVAL (last14.num14) DAY as last14day		from (	select 	0 	as 	num14	
            union all select 1             union all select 2             union all select 3             union all select 4             union all select 5             
            union all select 6             union all select 7             union all select 8             union all select 9	            union all select 10
            union all select 11            union all select 12            union all select 13            union all select 14            ) as last14
) as temp
left join codes on date_format(codes.created_at, '%Y-%m-%d') = temp.last14day group by temp.last14day order by temp.last14day asc limit 15;
EOT;

static $all_flow_sql = <<<EOT
SELECT DAY(temp.last14day) as date, count(id) as 'sum'
FROM (
            select curdate() - INTERVAL (last14.num14) DAY as last14day		from (	select 	0 	as 	num14	
            union all select 1             union all select 2             union all select 3             union all select 4             union all select 5             
            union all select 6             union all select 7             union all select 8             union all select 9	            union all select 10
            union all select 11            union all select 12            union all select 13            union all select 14            ) as last14
) as temp
left join records on date_format(records.created_at, '%Y-%m-%d') = temp.last14day group by temp.last14day order by temp.last14day asc limit 15;
EOT;


static $today_all_order_sql = <<<EOT


EOT;

    static function all_total()
    {
        $result = DB::select(self::$all_total_sql);

        return array_map(function ($e) {
            return $e->sum;
        }, $result);
    }

    static function all_refund()
    {
        $result = DB::select(self::$all_refund_sql);

        return array_map(function ($e) {
            return $e->sum;
        }, $result);
    }

    static function item_total($order_type)
    {
        $result = DB::select(self::$item_total_sql, [$order_type]);

        return array_map(function ($e) {
            return $e->sum;
        }, $result);
    }

    static function item_refund($order_type)
    {
        $result = DB::select(self::$item_refund_sql, [$order_type]);

        return array_map(function ($e) {
            return $e->sum;
        }, $result);
    }



    static function all_user()
    {
        $result = DB::select(self::$all_user_sql);

        return array_map(function ($e) {
            return $e->sum;
        }, $result);
    }

    static function all_msg()
    {
        $result = DB::select(self::$all_msg_sql);

        return array_map(function ($e) {
            return $e->sum;
        }, $result);
    }



    static function all_flow()
    {
        $result = DB::select(self::$all_flow_sql);

        return array_map(function ($e) {
            return $e->sum;
        }, $result);
    }
}
