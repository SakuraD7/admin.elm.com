<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model{
    //声明可被接收的变量
    protected $fillable = ['name','url','permission_id','pid'];
    //获取导航菜单
    public static function getNavs(){
        $html = '';
        //生成导航菜单
        //获取所有一级菜单
        $navs = Nav::where('pid',0)->get();
        //遍历一级菜单，生成html
        foreach ($navs as $nav){
            $html .= '<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$nav['name'].'<span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                    //获取该一级菜单的子菜单
            $children = Nav::where('pid',$nav['id'])->get();
            foreach ($children as $child){
                //dd($child);
                $html .= '<li><a href="'.route($child['url']).'">'.$child['name'].'</a></li>';
            }
            $html .= '</ul></li>';
        }
        return $html;
    }
}
