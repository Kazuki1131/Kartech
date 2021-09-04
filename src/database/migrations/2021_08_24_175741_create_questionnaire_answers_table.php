<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnaireAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('questionnaire_id')->unsigned();
            $table->text('answer')->nullable();
            $table->timestamps();

            //外部キー制約
            $table->foreign('customer_id')
            ->references('id')->on('customers')
            ->onDelete('cascade');

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
        Schema::dropIfExists('questionnaire_answers');
    }
}
