<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('category_id');
            $table->string('purpose')->index(); // 1轉學考 2研究所 3公職
            $table->string('type')->index(); // 1是非 2選擇 3問答 4
            $table->longText('question');
            $table->longText('answer'); // for 是非,問答
            $table->string('option1')->nullable(); // 選擇題
            $table->string('option2')->nullable();
            $table->string('option3')->nullable();
            $table->string('option4')->nullable();
            $table->string('option5')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
