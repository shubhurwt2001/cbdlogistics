<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_de');
            $table->string('name_fr');
            $table->string('name_it');
            $table->string('slug_en');
            $table->string('slug_de');
            $table->string('slug_fr');
            $table->string('slug_it');
            $table->string('image_slug_en');
            $table->string('image_slug_de');
            $table->string('image_slug_fr');
            $table->string('image_slug_it');
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
        Schema::dropIfExists('categories');
    }
}
