<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnaireOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('questionnaire_id')->unsigned();
            $table->string('option')->nullable();
            $table->timestamps();

            //外部キー制約
            $table->foreign('questionnaire_id')
            ->references('id')->on('questionnaires')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnaire_options');
    }
}
