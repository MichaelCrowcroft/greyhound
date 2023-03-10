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
        Schema::create('lighthouse_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lighthouse_reportable_id');
            $table->string('lighthouse_reportable_type');

            $table->integer('performance');
            $table->integer('accessibility');
            $table->integer('best_practices');
            $table->integer('seo');
            $table->integer('pwa');

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
        Schema::dropIfExists('lighthouse_reports');
    }
};
