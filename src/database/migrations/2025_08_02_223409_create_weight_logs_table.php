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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ← 必須
            $table->date('date');
            $table->float('weight', 4, 1);
            $table->integer('calories')->nullable();
            $table->integer('exercise_time')->nullable();
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
        Schema::table('weight_logs', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
    }
}
