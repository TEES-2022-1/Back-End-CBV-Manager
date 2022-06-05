<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technical_committees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string("coach", 256);
            $table->string("coach_assistant", 256);
            $table->string("supervisor", 256);
            $table->string("personal_trainer", 256);
            $table->string("physiotherapist", 256);
            $table->string("masseuse", 256);
            $table->string("doctor", 256);

            $table->foreign('team_id')
                ->on('teams')
                ->references('id')
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
        Schema::dropIfExists('technical_committees');
    }
};
