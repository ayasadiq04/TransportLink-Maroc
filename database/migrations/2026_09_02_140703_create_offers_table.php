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
                ->restrictOnDelete();

            $table->decimal('amount', 10, 2);

            $table->text('message')->nullable();

            $table->text('conditions')->nullable();

            $table->string('estimated_delivery_time')->nullable();

            $table->enum('status', [
                'pending',
                'accepted',
                'rejected',
                'cancelled'
            ])->default('pending');

            $table->timestamps();

            $table->unique([
                'transport_request_id',
                'transporteur_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};