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
            $table->string('name', 250);
            $table->string('name_en', 250)->nullable();
            $table->string('image', 250);
            $table->string('description', 250)->nullable();
            $table->text('info')->nullable();
            $table->integer('cost_price');
            $table->integer('sale_price')->nullable();
            $table->string('unit', 20);
            $table->integer('count')->default(0);
            $table->string('slug', 300)->nullable();
            $table->boolean('status')->default(true);
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
