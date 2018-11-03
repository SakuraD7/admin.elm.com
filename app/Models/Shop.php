<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //声明可被接收的变量
    protected $fillable = ['shop_category_id','shop_name','shop_img','shop_rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','status'];
    //获取该商家的所属分类 一对多（反向）
    public function ShopCategory(){
        return $this->belongsTo(ShopCategory::class,'shop_category_id','id');//Shop::class
    }
}
