<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('author_id')->constrained();
            $table->double('price'); // price for one unit
            $table->double('sale_price')->nullable(); // price for one unit when on sale
            $table->string('isbn');
            $table->char('language', 2); // language shortcut (CS, EN, DE)
            $table->foreignId('category_id')->constrained();
            $table->string('publisher')->nullable();
            $table->integer('available'); // available quantity
            $table->text('description');
            $table->integer('year')->nullable();
            $table->string('photo_path')->nullable(); // if null, a placeholder photo is used instead
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
        Schema::dropIfExists('books');
    }
}
