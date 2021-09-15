<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('shop_id')->unsigned();
            $table->bigInteger('control_number')->unsigned();
            $table->string('name')->nullable();
            $table->string('name_kana');
            $table->tinyInteger('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('tel');
            $table->string('email')->nullable();
            $table->text('memo')->nullable();
            $table->timestamps();

            //外部キー制約
            $table->foreign('shop_id')
            ->references('id')->on('shops')
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
        Schema::dropIfExists('customers');
    }
}
