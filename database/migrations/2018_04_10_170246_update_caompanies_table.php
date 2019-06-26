<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCaompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
   
            //测试移除
            Schema::table('caompanies', function($table){
                
                // 判断数据表是否有该列
                if(Schema::hasColumn('caompanies', 'user_level')){
                    //删除指定字段
                    $table->dropColumn('user_level');
                 }

                  // 判断数据表是否有该列
                if(!Schema::hasColumn('caompanies', 'status')){
                
                    $table->integer('status')->nullable()->default(0)->comment('审核状态0审核中1通过2不通过');
                }

            });
            
       

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
