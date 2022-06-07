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
        Schema::create('confrontations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('league_id');
            $table->unsignedBigInteger('team_host_id');
            $table->unsignedBigInteger('team_guest_id');
            $table->dateTime('scheduling');

            $table->integer('result_host')->nullable();
            $table->integer('result_guest')->nullable();
            $table->integer('set1_points_host')->nullable();
            $table->integer('set1_points_guest')->nullable();
            $table->integer('set2_points_host')->nullable();
            $table->integer('set2_points_guest')->nullable();
            $table->integer('set3_points_host')->nullable();
            $table->integer('set3_points_guest')->nullable();
            $table->integer('set4_points_host')->nullable();
            $table->integer('set4_points_guest')->nullable();
            $table->integer('set5_points_host')->nullable();
            $table->integer('set5_points_guest')->nullable();

            $table->unsignedBigInteger('confrontable_id');
            $table->string('confrontable_type');

            $table->foreign('league_id')
                ->on('leagues')
                ->references('id')
                ->onDelete('cascade');

            $table->foreign('team_host_id')
                ->on('teams')
                ->references('id')
                ->onDelete('cascade');

            $table->foreign('team_guest_id')
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
        Schema::dropIfExists('confrontations');
    }
};
