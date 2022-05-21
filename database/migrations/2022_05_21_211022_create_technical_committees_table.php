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
            $table->integer('year');
            $table->string("coach", 256);
            $table->string("coach_assistent", 256);
            $table->string("supervisor", 256);
            $table->string("personal_trainer", 256);
            $table->string("physiotherapist", 256);
            $table->string("masseuse", 256);
            $table->string("doctor", 256);
            $table->timestamps();

            // Faz do campo 'team_id' uma chave estrangeira para a tabela teams.
            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
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
