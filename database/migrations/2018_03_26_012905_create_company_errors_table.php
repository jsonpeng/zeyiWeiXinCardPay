<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyErrorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_errors', function (Blueprint $table) {
            $table->increments('id');
            $table->text('reason');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('caompanies');

            $table->integer('status')->nullable()->default(0)->comment('0未读1已读');

            $table->index(['id', 'created_at']);
            $table->index('company_id');
            
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
        Schema::drop('company_errors');
    }
}
