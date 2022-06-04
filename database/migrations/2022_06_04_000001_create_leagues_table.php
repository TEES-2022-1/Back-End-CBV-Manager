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
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->string('title', 256);
            $table->integer('year');
            $table->enum('category', ['MALE', 'FEMALE']);
            $table->date('begin_in');
            $table->date('classificatory_limit');
            $table->date('quarter_finals_limit');
            $table->date('semifinals_limit');
            $table->date('finish_in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leagues');
    }
};
