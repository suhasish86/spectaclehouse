<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productname', 255);
            $table->string('productslug', 255);
            $table->string('genre', 255);
            $table->string('productsku', 255);
            $table->string('browsertitle', 255);
            $table->string('metadescription', 255);
            $table->string('metakeyword', 255);
            $table->integer('style');
            $table->integer('brand');
            $table->text('description');
            $table->text('specification');
            $table->decimal('price', 10, 2)->default('0.00');
            $table->decimal('discount', 10, 2)->default('0.00');
            $table->char('discountby', 30)->default('Amount');
            $table->string('image', 255)->nullable();
            $table->integer('author');
            $table->char('status', 1)->default(0);
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
        Schema::dropIfExists('products');
    }
}
