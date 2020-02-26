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
            $table->unsignedDecimal('price');
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('author')->nullable();
            $table->string('book_publisher')->nullable();
            $table->date('published_date')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->double('weight')->nullable();
            $table->double('pages')->nullable(); 
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('condition_id')->nullabe(); //to store the condition of the book
           // $table->unsignedInteger('category_id')->nullabe(); //to store the category of the book           
           $table->boolean('featured')->default(false);
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
