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
        Schema::create('procurements', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('project_name')->nullable();
            $table->string('procurement_name');
            $table->string('vendor_name');
            $table->string('pr_number')->nullable();
            $table->string('po_number')->nullable();
            $table->decimal('po_value', 20, 2)->default(0);
            $table->string('currency')->default('IDR');
            $table->date('due_date')->nullable();
            $table->string('wbs')->nullable();
            
            // Checklists (boolean)
            $table->boolean('status_hps')->default(false);
            $table->boolean('status_rks')->default(false);
            $table->boolean('status_topup')->default(false);
            $table->boolean('status_pr')->default(false);
            $table->boolean('status_rfq')->default(false);
            $table->boolean('status_nego')->default(false);
            $table->boolean('status_po')->default(false);
            $table->boolean('status_top')->default(false);
            $table->boolean('status_submit_dok')->default(false);
            $table->boolean('status_gr_ses')->default(false);
            $table->boolean('status_sptjb')->default(false);
            
            // Additional Info
            $table->string('no_spp')->nullable();
            $table->string('nilai_ket_transfer')->nullable();
            
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
        Schema::dropIfExists('procurements');
    }
};
