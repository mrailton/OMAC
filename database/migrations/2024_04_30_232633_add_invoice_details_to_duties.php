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
        Schema::table('duties', function (Blueprint $table): void {
            $table->decimal('invoice_amount')->nullable();
            $table->date('invoice_paid_on')->nullable();
            $table->string('invoice_payment_method')->nullable();
        });
    }
};
