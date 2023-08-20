<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->date('cert_expires_on')->nullable();
            $table->string('cert_number')->nullable();
            $table->string('garda_vetting_id')->nullable();
            $table->date('garda_vetting_date')->nullable();
            $table->date('cpap_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
