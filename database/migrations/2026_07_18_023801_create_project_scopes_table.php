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
    public function up(): void
    {
        Schema::create('project_scopes', function (Blueprint $table) {
            $table->id();
            $table->string('system_name');
            $table->text('description')->nullable();
            $table->string('category');
            $table->string('principal');
            $table->string('principal_country_code')->nullable();
            $table->string('status');
            $table->integer('progress')->default(0);
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
        Schema::dropIfExists('project_scopes');
    }
};
