<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSalesReceiptsTable extends Migration
{
    public function up()
    {
        Schema::create('sales_receipts', function (Blueprint $table) {
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('receipt_id');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('receipt_id')->references('id')->on('receipts')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['sale_id','receipt_id']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('sales_receipts');
    }
}
