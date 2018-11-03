<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->increments('id');//主键
            $table->string('name');//名称
            $table->string('type_accumulation');//菜品编号（a-z前端使用）
            $table->tinyInteger('shop_id');//所属商家ID
            $table->string('description');//描述
            $table->tinyInteger('is_selected');//是否是默认分类
            $table->timestamps();
            $table->engine='innoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_categories');
    }
}
