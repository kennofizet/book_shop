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
            $table->string('name',255);
            $table->string('type',255)->nullable();
            $table->longText('description');
            $table->longText('content');
            $table->integer('price');
            $table->integer('sale_price')->nullable();
            $table->tinyInteger('status_count');
            $table->string('image',255);
            $table->string('slug',255);
            $table->integer('parent');
            $table->integer('total_cart')->nullable();
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
