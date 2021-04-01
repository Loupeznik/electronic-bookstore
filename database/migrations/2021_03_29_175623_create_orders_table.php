<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->double('sum'); // overall order cost
            $table->double('vat'); // VAT amount
            $table->integer('status');
            $table->foreignUuid('payment_method_id')->constrained('payment_methods'); // payment method
            $table->foreignUuid('cart_id')->constrained(); // cart is passing ordered items into the order
            $table->foreignId('assignee')->constrained('users')->nullable(); // should be null as default as it will be assigned to an admin later
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('shipping_id')->constrained('shipping_methods'); // shipping method
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
        Schema::dropIfExists('orders');
    }
}
