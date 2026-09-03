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
    Schema::create('transport_requests', function (Blueprint $table) {
        $table->id();

        $table->foreignId('client_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->string('title');

        $table->string('departure_city');
        $table->string('departure_address');

        $table->string('destination_city');
        $table->string('destination_address');

        $table->dateTime('pickup_at');

        $table->enum('goods_type', [
            'palette',
            'vrac',
            'frigorifique',
            'liquide',
            'colis_volumineux',
            'autre'
        ]);

        $table->decimal('weight', 10, 2)->nullable();
        $table->decimal('volume', 10, 2)->nullable();

        $table->text('instructions')->nullable();

        $table->decimal('estimated_budget', 10, 2)->nullable();

        $table->enum('status', [
            'pending',
            'accepted',
            'completed',
            'cancelled'
        ])->default('pending');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_requests');
    }
};
