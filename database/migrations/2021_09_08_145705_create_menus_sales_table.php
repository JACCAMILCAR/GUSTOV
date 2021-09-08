<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateMenusSalesTable extends Migration
{
    public function up()
    {
        Schema::create('menus_sales', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('sale_id');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['menu_id','sale_id']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('menus_sales');
    }
}
