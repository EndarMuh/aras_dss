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
        Schema::create('list_dss', function (Blueprint $table) {
            $table->id();
            $table->string('dss_title');
            $table->integer('altCount')->default(0);
            $table->integer('critCount')->default(0);
            $table->boolean('isCounted')->default(false);
            $table->boolean('isPrepared')->default(false);
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
        Schema::dropIfExists('list_dss');
    }
};
