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
        Schema::create('aras_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dss_id')->constrained('list_dss')->nullable()->default(null)->onDelete('cascade');
            $table->string('name_alternative_res')->default(null);
            $table->float('score', 8, 4)->default(0);
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
        Schema::dropIfExists('aras_results');
    }
};
