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
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('subcategory_id')->nullable();
            $table->string('name_en');
            $table->string('name_de');
            $table->string('name_fr');
            $table->string('name_it');
            $table->double('price_usd', 2)->default(0);
            $table->double('price_eur', 2)->default(0);
            $table->double('price_rub', 2)->default(0);
            $table->double('price_chf', 2)->default(0);
            $table->integer('quantity');
            $table->string('slug_en');
            $table->string('slug_de');
            $table->string('slug_fr');
            $table->string('slug_it');
            $table->longText('short_desc_en')->nullable();
            $table->longText('short_desc_de')->nullable();
            $table->longText('short_desc_fr')->nullable();
            $table->longText('short_desc_it')->nullable();
            $table->longText('desc_en')->nullable();
            $table->longText('desc_de')->nullable();
            $table->longText('desc_fr')->nullable();
            $table->longText('desc_it')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_fr')->nullable();
            $table->string('meta_title_it')->nullable();
            $table->string('meta_title_de')->nullable();
            $table->string('meta_content_en')->nullable();
            $table->string('meta_content_fr')->nullable();
            $table->string('meta_content_it')->nullable();
            $table->string('meta_content_de')->nullable();
            $table->string('meta_keyword_en')->nullable();
            $table->string('meta_keyword_fr')->nullable();
            $table->string('meta_keyword_it')->nullable();
            $table->string('meta_keyword_de')->nullable();
            $table->string('reference')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('deleted')->default(0);
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
