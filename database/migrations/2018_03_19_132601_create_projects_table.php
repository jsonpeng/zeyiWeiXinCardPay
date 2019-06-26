<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('项目名称');
            $table->string('mobile')->comment('电话');
            $table->string('weixin')->nullable()->comment('微信或QQ');
            $table->float('money')->comment('项目金额');
            $table->enum('type', [
                    '项目',
                    '需求'
                ])->comment('供给 需求');
            $table->integer('province')->comment('省');
            $table->integer('city')->comment('市');
            $table->integer('district')->nullable()->comment('区');
            $table->string('address')->nullable()->comment('地址');
            $table->longtext('detail')->comment('项目信息');
            $table->enum('status', [
                    '正常',
                    '暂停'
                ])->comment('项目状态');

            $table->enum('auth_status', [
                    '审核中',
                    '通过',
                    '不通过'
                ])->comment('审核状态');

            $table->string('auth_result')->nullable()->comment('审核评论');
            $table->integer('view')->nullable()->default(0)->comment('浏览量');
            $table->integer('collections')->nullable()->default(0)->comment('收藏量');

            //行业
            // $table->integer('industry_id')->unsigned();
            // $table->foreign('industry_id')->references('id')->on('industries');
            // 项目提交人
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });

        //industry_project
        Schema::create('industry_project', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('industry_id')->unsigned();
            $table->foreign('industry_id')->references('id')->on('industries');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('project_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::drop('project_user');
        Schema::drop('industry_project');
        Schema::drop('projects');
    }
}
