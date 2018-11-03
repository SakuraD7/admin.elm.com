<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');//主键
            $table->tinyInteger('user_id');//用户id
            $table->string('province');//省
            $table->string('city');//市
            $table->string('county');//县
            $table->string('address');//详细地址
            $table->string('tel');//收货人电话
            $table->string('name');//收货人姓名
            $table->tinyInteger('is_default');//是否是默认地址
            $table->timestamps();//时间
            $table->engine='innoDB';//设置储存引擎
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
