<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Url extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_links',function (Blueprint $table){
            // 设置表引擎
            $table->engine="InnoDB";
            // 字符集
            $table->charset = 'utf8';
            //校队
            $table->collation = "utf8_unicode_ci";

            $table->increments('l_id')->comment('链接id，主键');
            $table->char('l_name',30)->comment('链接名字');
            $table->char('l_url',255)->comment('网址');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news_links');
    }
}
