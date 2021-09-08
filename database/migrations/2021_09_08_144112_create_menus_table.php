<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('price');
            $table->string('description')->nullable();
            $table->boolean('state');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
