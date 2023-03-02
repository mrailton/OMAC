<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('omac_id_number')->nullable();
            $table->string('clinical_level');
            $table->string('cfr_level')->nullable();
            $table->date('cfr_expires_on')->nullable();
            $table->string('cfr_cert_number')->nullable();
            $table->date('far_expires_on')->nullable();
            $table->string('far_cert_number')->nullable();
            $table->date('efr_expires_on')->nullable();
            $table->string('efr_cert_number')->nullable();
            $table->string('phecc_pin')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
