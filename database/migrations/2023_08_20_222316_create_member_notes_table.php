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
        Schema::create('member_notes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('member_id');
            $table->text('note');
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
