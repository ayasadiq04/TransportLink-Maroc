<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transport_request_id')
                ->constrained('transport_requests')
                ->cascadeOnDelete();

            $table->foreignId('transporteur_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('vehicle_id')
                ->constrained('vehicles')
                ->cascadeOnDelete();

            $table->decimal('price', 10, 2);

            $table->text('message')->nullable();

            $table->enum('status', [
                'pending',
                'accepted',
                'rejected'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};