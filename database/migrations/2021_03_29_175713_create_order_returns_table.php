<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_returns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('order_id')->constrained(); // references an order
            $table->integer('status')->default(0); // return status: 0 - received, 1 - under review, 2 - finished
            $table->integer('result')->nullable(); // return result: 0 - order refunded, 1 - exchanged goods, 2 - return not accepted, ...
            $table->text('description'); // description
            $table->foreignId('assignee')->nullable()->constrained('users'); // can be assigned to an admin afterwards
            $table->datetime('completed_at')->nullable(); // date of return completion (set when status is set to 2)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_returns');
    }
}
