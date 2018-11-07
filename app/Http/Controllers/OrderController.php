<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller{
    //最近一周订单量
    public function order(){
        //开始统计时间
        $created = date('Y-m-d 00:00:00',strtotime('-6 day'));
        //结束统计时间
        $updated = date('Y-m-d 23:59:59');
        $sql = "select date(created_at) as date,count(*) as count from orders
        where created_at >= '{$created}'
        and created_at <= '{$updated}'
        group by date(created_at)";
        $orders = DB::select($sql);
        //dd($orders);
        $dates = [];
        for($i=6;$i>=0;$i--){
            $dates[date('Y-m-d',strtotime("-{$i} day"))] = 0;
        }
        //dd($dates);
        foreach ($orders as $order){
            $dates[$order->date] = $order->count;
        }

        //最近三月的订单量
        $created2 = date('Y-m-01 00:00:00',strtotime('-2 month'));
        $updated2 = date('Y-m-d 23:59:59');
        $sql2 = "select month(created_at) as d,count(*) as c from orders 
        where created_at >= '{$created2}'
        and created_at <= '{$updated2}'
        group by month(created_at)";
        $orders2 = DB::select($sql2);
        //拼接成合适的格式
        $Y=date('Y-');
        foreach ($orders2 as $k => $v){
            if($v->d<10){
                $v->d = '0'.$v->d;
            }
            $v->d = $Y.$v->d;
        }
        $dates2 = [];
        for($i=2;$i>=0;$i--){
            $dates2[date('Y-m',strtotime("-{$i} month"))] = 0;
        }
        foreach ($orders2 as $order2){
            $dates2[$order2->d] = $order2->c;
        }
        return view('orders.order',compact('dates','dates2'));
    }

    //最近一周菜品销量统计
    public function sales_volume(){
        //开始统计时间
        $created3 = date('Y-m-d 00:00:00',strtotime('-6 day'));
        //结束统计时间
        $updated3 = date('Y-m-d 23:59:59');
        $sql3 ="SELECT
                    DATE(order_details.created_at) as date,
                    order_details.goods_id,
                    SUM(order_details.amount) as sum
                FROM
                    order_details
                JOIN orders ON orders.id = order_details.order_id
                WHERE order_details.created_at >= '{$created3}'
                AND order_details.created_at <= '{$updated3}'
                GROUP BY
                    DATE(orders.created_at),
                    order_details.goods_name";
        $orders3 = DB::select($sql3);
        $dates3 = [];
        //获取所有商家菜品列表
        $menus = Menu::select('id','goods_name')->get();

        $keyed = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['goods_name']];
        });
        $keyed2 = $menus->mapWithKeys(function ($item) {
            return [$item['id']=>0];
        });
        $menus = $keyed->all();
        $week = [];
        for($i=6;$i>=0;$i--){
            $week[] = date('Y-m-d',strtotime("-{$i} day"));
        }
        foreach ($menus as $id=>$name){
            foreach ($week as $day){
                $dates3[$id][$day] = 0;
            }
        }
        foreach ($orders3 as $order3){
            $dates3[$order3->goods_id][$order3->date] = $order3->sum;
        }
        $series = [];
        foreach ($dates3 as $id=>$data){
            $serie = [
                'name'=> $menus[$id],
                'type'=>'line',
                'data'=>array_values($data)
            ];
            $series[] = $serie;
        }

        //最近三月的菜品销量
        $created4 = date('Y-m-01 00:00:00',strtotime('-2 month'));
        $updated4 = date('Y-m-d 23:59:59');
        $sql4 ="SELECT
                    month(order_details.created_at) as date,
                    order_details.goods_id,
                    SUM(order_details.amount) as sum
                FROM
                    order_details
                JOIN orders ON orders.id = order_details.order_id
                WHERE order_details.created_at >= '{$created4}'
                AND order_details.created_at <= '{$updated4}'
                GROUP BY
                    month(orders.created_at),
                    order_details.goods_name";
        $orders4 = DB::select($sql4);
        $Y=date('Y-');
        foreach ($orders4 as $k => $v){
            if($v->date<10){
                $v->date = '0'.$v->date;
            }
            $v->date = $Y.$v->date;
        }
        $dates4 = [];
        $week4 = [];
        for($i=2;$i>=0;$i--){
            $week4[] = date('Y-m',strtotime("-{$i} month"));
        }
        foreach ($menus as $id=>$name){
            foreach ($week4 as $day){
                $dates4[$id][$day] = 0;
            }
        }
        foreach ($orders4 as $order4){
            $dates4[$order4->goods_id][$order4->date] = $order4->sum;
        }
        $series4 = [];
        foreach ($dates4 as $id=>$data){
            $serie = [
                'name'=> $menus[$id],
                'type'=>'line',
                'data'=>array_values($data)
            ];
            $series4[] = $serie;
        }
        return view('orders.sales_volume',compact('dates3','menus','week','series','dates4','week4','series4'));
    }
}
