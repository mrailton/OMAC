<?php

declare(strict_types=1);

use App\Models\Medication;
use App\Models\MedicationBag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medication_bag_stocks', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Medication::class);
            $table->foreignIdFor(MedicationBag::class);
            $table->string('quantity');
            $table->date('expiry_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_bag_stocks');
    }
};
