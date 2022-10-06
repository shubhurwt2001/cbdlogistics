<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question_en')->nullable();
            $table->longText('answer_en')->nullable();
            $table->string('question_fr')->nullable();
            $table->longText('answer_fr')->nullable();
            $table->string('question_it')->nullable();
            $table->longText('answer_it')->nullable();
            $table->string('question_de')->nullable();
            $table->longText('answer_de')->nullable();
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
        Schema::dropIfExists('faqs');
    }
}
