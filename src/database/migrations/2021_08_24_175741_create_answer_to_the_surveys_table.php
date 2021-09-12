<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerToTheSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_to_the_surveys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('survey_id')->unsigned();
            $table->text('answer')->nullable();
            $table->timestamps();

            //外部キー制約
            $table->foreign('customer_id')
            ->references('id')->on('customers')
            ->onDelete('cascade');

            $table->foreign('survey_id')
            ->references('id')->on('surveys')
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
        Schema::dropIfExists('answer_to_the_surveys');
    }
}
