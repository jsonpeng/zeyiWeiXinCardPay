<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->default('')->nullable()->comment('属性名称');
            $table->string('value', 512)->default('')->nullable()->comment('属性值');
            $table->string('group', 50)->default('')->nullable()->comment('属性分组');
            $table->string('des', 50)->default('')->nullable()->comment('属性描述');

            $table->index(['id', 'created_at']);

            /*
            $table->string('name')->default('')->nullbale()->comment('店铺名称');
            $table->string('icp')->default('')->nullbale()->comment('ICP备案信息');
            $table->string('logo')->default('')->nullbale()->comment('LOGO');
            $table->string('seo_title')->default('')->nullbale()->comment('网站标题');
            $table->string('seo_des')->default('')->nullbale()->comment('网站描述');
            $table->string('seo_keywords')->default('')->nullbale()->comment('网站关键字');
            $table->string('weixin')->default('')->nullbale()->comment('微信公众号');
            $table->integer('freight_free_limit')->default(200)->nullbale()->comment('全场满多少免运费 0不免运费');
            $table->integer('inventory_default')->default(1)->nullbale()->comment('默认库存');
            $table->integer('inventory_warn')->default(0)->nullbale()->comment('库存预警数');
            $table->integer('withdraw_limit')->default(200)->nullbale()->comment('满多少才能提现');
            $table->integer('withdraw_min')->default(200)->nullbale()->comment('最少提现额度');
            $table->tinyInteger('account_bind')->default(0)->nullbale()->comment('第三方登录是否必须绑定 0 否 1 是');

            $table->string('sms_platform')->default('阿里云')->nullbale()->comment('短信平台');
            $table->string('sms_appkey')->default('')->nullbale()->comment('短信平台[appkey]');
            $table->string('sms_secretKey')->default('')->nullbale()->comment('短信平台[secretKey]');
            $table->tinyInteger('sms_send_register')->default(0)->nullbale()->comment('用户注册时是否发送短信 0 否 1 是');
            $table->tinyInteger('sms_send_password')->default(0)->nullbale()->comment('用户找回密码时是否发送短信 0 否 1 是');
            $table->tinyInteger('sms_send_account_check')->default(0)->nullbale()->comment('身份验证时是否发送短信 0 否 1 是');
            $table->tinyInteger('sms_send_order')->default(0)->nullbale()->comment('用户下单时是否发送短信给商家 0 否 1 是');
            $table->tinyInteger('sms_send_pay')->default(0)->nullbale()->comment('客户支付时是否发短信给商家 0 否 1 是');
            $table->tinyInteger('sms_send_deliver')->default(0)->nullbale()->comment('商家发货时是否给客户发短信 0 否 1 是');
            
            $table->integer('register_credits')->default(0)->nullbale()->comment('注册赠送积分');
            $table->tinyInteger('invite_switch')->default(0)->nullable()->comment('邀请开关 0 否 1 是'); 
            $table->integer('invite_credits')->default(0)->nullbale()->comment('邀请人获赠积分');
            $table->integer('credits_rate')->default(10)->nullbale()->comment('1元能兑换多少积分');
            $table->tinyInteger('credits_force')->default(1)->nullbale()->comment('积分商品只能用积分购买 0 否 1 是');
            $table->integer('auto_complete')->default(7)->nullbale()->comment('自动确认收货时间');
            $table->integer('after_sale_time')->default(15)->nullbale()->comment('多少天内可申请售后');
            $table->tinyInteger('inventory_consume')->default(1)->nullbale()->comment('减库存的时机 0 下单成功 1 支付成功');

            $table->string('email_host')->default('')->nullbale()->comment('smtp host');
            $table->string('email_port')->default('')->nullbale()->comment('smtp port');
            $table->string('email_username')->default('')->nullbale()->comment('邮箱登录名');
            $table->string('email_password')->default('')->nullbale()->comment('邮箱密码');
            $table->string('email_encrypt')->default('')->nullbale()->comment('加密');

            $table->tinyInteger('distribution')->default(0)->nullbale()->comment('是否开启分销 0 不开启 1 开启');
            $table->tinyInteger('distribution_condition')->default(0)->nullbale()->comment('是否需购买商品才能成为分销 0 不需要 1 需要');
            $table->tinyInteger('distribution_type')->default(0)->nullbale()->comment(' 0 按商品提成 1 按订单金额提成');
            $table->integer('distribution_percent')->default(15)->nullbale()->comment('订单金额提成比例');
            $table->integer('distribution_selft')->default(0)->nullbale()->comment('购买者提成点');
            $table->string('distribution_level1_name')->default(0)->nullbale()->comment('一级分销商名称');
            $table->integer('distribution_level1_percent')->default(0)->nullbale()->comment('一级分销商提成比例');
            $table->string('distribution_level2_name')->default(0)->nullbale()->comment('二级分销商名称');
            $table->integer('distribution_level2_percent')->default(0)->nullbale()->comment('二级分销商提成比例');
            $table->string('distribution_level3_name')->default(0)->nullbale()->comment('三级分销商名称');
            $table->integer('distribution_level3_percent')->default(0)->nullbale()->comment('三级分销商提成比例');

            $table->longtext('agree')->nullbale()->comment('服务协议');
            
            $table->string('feie_sn')->default('')->nullbale()->comment('飞蛾小票打印机SN');
            $table->string('feie_user')->default('')->nullbale()->comment('飞蛾小票打印机USER');
            $table->string('feie_ukey')->default('')->nullbale()->comment('飞蛾小票打印机UKEY');
            */
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
        Schema::drop('settings');
    }
}
