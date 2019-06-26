<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCaompaniesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caompanies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('企业名称');
            $table->string('mobile')->comment('电话');
            $table->string('weixin')->nullable()->comment('微信');
            $table->integer('province')->comment('省');
            $table->integer('city')->comment('市');
            $table->integer('district')->comment('区');
            $table->string('detail')->nullable()->comment('详细地址');
            $table->longtext('intro')->nullable()->comment('企业介绍');
            $table->integer('view')->nullable()->default(0)->comment('浏览量');
            $table->integer('collect')->nullable()->default(0)->comment('收藏量');
            $table->string('lat')->nullable()->comment('纬度');
            $table->string('lon')->nullable()->comment('精度');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('caompany_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('caompany_id')->unsigned();
            $table->foreign('caompany_id')->references('id')->on('caompanies');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('caompany_user');
        Schema::drop('caompanies');
    }
}
