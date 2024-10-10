<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_data', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('label_id')->nullable();
            // $table->foreign('label_id', 'label_id_fk_478877309')->references('id')->on('labels')->onDelete('cascade');

            // $table->unsignedBigInteger('page_id')->nullable();
            // $table->foreign('page_id', 'page_id_fk_474777309')->references('id')->on('pages')->onDelete('cascade');

            // $table->unsignedBigInteger('blog_id')->nullable();
            // $table->foreign('blog_id', 'blog_id_fk_47474009')->references('id')->on('blogs')->onDelete('cascade');

            // $table->unsignedBigInteger('category_id')->nullable();
            // $table->foreign('category_id', 'category_id_fk_47343597')->references('id')->on('categories')->onDelete('cascade');

            // $table->unsignedBigInteger('product_id')->nullable();
            // $table->foreign('product_id', 'product_id_fk_47348897')->references('id')->on('products')->onDelete('cascade');
            
            $table->text('title')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();

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
        Schema::dropIfExists('meta_data');
    }
};
