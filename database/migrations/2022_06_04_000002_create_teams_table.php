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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('league_id');
            $table->string('name', 256);
            $table->integer('year_foundation');
            $table->string('gymnasium');
            $table->enum('category', ['MALE', 'FEMALE']);
            $table->date('affiliated_federation_in');

            $table->foreign('league_id')
                ->on('leagues')
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
        Schema::dropIfExists('teams');
    }
};
