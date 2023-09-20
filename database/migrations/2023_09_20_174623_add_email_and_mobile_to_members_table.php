<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table): void {
            $table->string('email')->nullable()->after('omac_id_number');
            $table->string('phone')->nullable()->after('email');
        });
    }
};
