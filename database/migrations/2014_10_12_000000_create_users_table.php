<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();

            $table->string('head_image')->nullable()->comment('头像');
            $table->string('nickname')->nullable()->comment('昵称');
            $table->string('mobile')->nullable()->comment('手机');
            $table->string('openid')->nullable()->comment('微信OPEN ID');
            $table->string('unionid')->nullable()->comment('公众平台ID');
            $table->string('code')->nullable()->comment('推荐码');
            $table->string('share_qcode')->nullable()->comment('推荐二维码');
            $table->tinyInteger('status')->nullable()->default(0)->comment('状态0正常 1冻结');
            $table->integer('credits')->default(0)->comment('用户积分');
            $table->float('user_money')->default(0)->comment('用户金额');

            $table->string('member_id')->nullable()->comment('会员编号');

            $table->timestamp('last_login')->nullable()->comment('最后登录日期');
            $table->string('last_ip')->nullable()->comment('最后登录IP');
            $table->string('oauth')->nullable()->comment('第三方来源');
            $table->string('province')->nullable()->default('')->comment('省');
            $table->string('city')->nullable()->default('')->comment('市');
            $table->string('district')->nullable()->default('')->comment('区');

            $table->tinyInteger('lock')->nullable()->default(0)->comment('冻结用户 0 否 1 是');
        
            $table->integer('leader2')->unsigned()->nullable()->default(0)->comment('二级推荐人');
            $table->integer('leader3')->unsigned()->nullable()->default(0)->comment('三级推荐人');

            $table->integer('level1')->unsigned()->nullable()->default(0)->comment('一级下线数');
            $table->integer('level2')->unsigned()->nullable()->default(0)->comment('二级下线数');
            $table->integer('level3')->unsigned()->nullable()->default(0)->comment('三级下线数');


            $table->tinyInteger('is_distribute')->nullable()->default(0)->comment('是否是分拥商');
            $table->float('distribut_money')->default(0)->comment('提成总金额');
            $table->integer('leader1')->unsigned()->nullable()->default(0)->comment('推荐人id');
            //share_time
            $table->timestamp('share_time')->nullable()->comment('分享进入时间');
            //distribute_time
            $table->timestamp('distribute_time')->nullable()->comment('分享后购买的时间');
            $table->timestamp('member_buy_time')->nullable()->comment('会员购买时间');
            $table->timestamp('member_end_time')->nullable()->comment('会员有效期到');

            //会员等级
            $table->integer('user_level')->unsigned();
            $table->foreign('user_level')->references('id')->on('user_levels');

            $table->index(['id', 'created_at']);
            $table->index('user_level');


            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
