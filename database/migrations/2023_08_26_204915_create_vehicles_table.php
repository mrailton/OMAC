<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table): void {
            $table->id();
            $table->string('call_sign')->nullable();
            $table->string('registration')->nullable();
            $table->string('type');
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->timestamps();
        });
    }
};
