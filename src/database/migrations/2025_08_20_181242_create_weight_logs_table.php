<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_logs', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            /*usersテーブルとのリレーションのため、下記外部キーの追加*/ 
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->decimal('weight', 4, 1); //最大 99.9 まで の値を保存できる
            $table->integer('calories')->nullable(); 
            $table->time('exercise_time')->nullable();
            $table->text('exercise_content')->nullable(); 
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
        Schema::dropIfExists('weight_logs');
    }
}
