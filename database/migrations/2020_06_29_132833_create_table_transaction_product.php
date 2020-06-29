<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransactionProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_product', function (Blueprint $table) {
            $table->foreignId('transaction_id')->constrained('transactions');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('harga');
            $table->integer('qty');
            $table->integer('total');

            $table->primary(['transaction_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_product');
    }
}
