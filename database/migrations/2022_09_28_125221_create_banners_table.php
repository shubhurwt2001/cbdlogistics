<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('title_fr')->nullable();
            $table->longText('description_fr')->nullable();
            $table->string('title_it')->nullable();
            $table->longText('description_it')->nullable();
            $table->string('title_de')->nullable();
            $table->longText('description_de')->nullable();
            $table->string('url');
            $table->string('alt_en')->nullable();
            $table->string('alt_fr')->nullable();
            $table->string('alt_it')->nullable();
            $table->string('alt_de')->nullable();
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
        Schema::dropIfExists('banners');
    }
}
