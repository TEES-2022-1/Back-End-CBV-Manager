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
        Schema::create('classifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('league_id');
            $table->unsignedBigInteger('team_id');
            $table->integer('confrontations_win')->nullable()->default(0);
            $table->integer('confrontations_loss')->nullable()->default(0);
            $table->integer('sets_win')->nullable()->default(0);
            $table->integer('sets_loss')->nullable()->default(0);
            $table->integer('points_win')->nullable()->default(0);
            $table->integer('points_loss')->nullable()->default(0);
            $table->integer('results_3_0')->nullable()->default(0);
            $table->integer('results_3_1')->nullable()->default(0);
            $table->integer('results_3_2')->nullable()->default(0);
            $table->integer('results_0_3')->nullable()->default(0);
            $table->integer('results_1_3')->nullable()->default(0);
            $table->integer('results_2_3')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifications');
    }
};
