<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('lo_number');
            $table->string('spbu_number');
            $table->string('ship_to');
            $table->decimal('quantity', 10, 2)->comment('Jumlah KL/DO dalam liter');
            $table->string('product_type');
            $table->decimal('distance_km', 8, 2)->comment('Jarak tempuh dalam km');
            $table->enum('status', ['available', 'in_progress', 'completed'])->default('available');
            $table->foreignId('driver_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('driver_name')->nullable();
            $table->string('karnet_number')->nullable();
            $table->timestamp('taken_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
