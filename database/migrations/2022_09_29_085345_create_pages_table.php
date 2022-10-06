<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('title_fr')->nullable();
            $table->string('title_it')->nullable();
            $table->string('title_de')->nullable();
            $table->longText('content_en')->nullable();
            $table->longText('content_fr')->nullable();
            $table->longText('content_it')->nullable();
            $table->longText('content_de')->nullable();
            $table->string('slug_en')->nullable();
            $table->string('slug_fr')->nullable();
            $table->string('slug_it')->nullable();
            $table->string('slug_de')->nullable();
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
            $table->boolean('in_menu')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('pages');
    }
}
