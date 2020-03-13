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
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('product_number');
            $table->string('product_number_replacements');
            $table->string('product_number_inner');
            // связь с таблицей product_model
            $table->integer('product_model_id');
            $table->text('description');
            $table->integer('price');
            // связь с таблицей category
            $table->integer('category_id');
            $table->boolean('product_recommend');
            $table->longText('images')->default(null);
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
        Schema::dropIfExists('products');
    }
}
