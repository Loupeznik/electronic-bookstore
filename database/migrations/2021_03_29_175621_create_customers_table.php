<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('id');
            $table->timestamps();
            $table->string('name');
            $table->string('surname');
            $table->foreignId('user_id')->nullable()->constrained(); // if user is registered, they pull their shipping info from this table
            $table->string('street');
            $table->integer('street_nr');
            $table->string('city');
            $table->integer('zip'); // postal code (ZIP / PSČ)
            $table->string('country');
            $table->integer('phone'); // phone number
            $table->string('email')->nullable(); // registered users won't be prompted for email to reduce redundancy
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
