<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColumnsAddIsInput extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        \Schema::table('columns',function(Blueprint $table){
            $table->tinyInteger('IS_INPUT')->default(1)->comment('是否从接口输入获取，1否，2是')->after('IS_NULLABLE');
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
        \Schema::table('columns',function(Blueprint $table){
            $table->dropColumn('IS_INPUT');
        });
    }
}
