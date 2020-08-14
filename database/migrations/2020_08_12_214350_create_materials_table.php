<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('materialname', 255);
            $table->string('materialslug', 255);
            $table->string('product', 255);
            $table->string('browsertitle', 255);
            $table->string('metadescription', 255);
            $table->string('metakeyword', 255);
            $table->string('banner', 255)->nullable();
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
        Schema::dropIfExists('materials');
    }
}
