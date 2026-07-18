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
        Schema::create('risks', function (Blueprint $table) {
            $table->id();
            $table->date('date_raised')->nullable();
            $table->string('risk');
            $table->text('risk_description')->nullable();
            $table->string('likelihood')->nullable();
            $table->string('impact')->nullable();
            $table->text('impact_description')->nullable();
            $table->string('risk_score')->nullable();
            $table->text('mitigation')->nullable();
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
        Schema::dropIfExists('risks');
    }
};
