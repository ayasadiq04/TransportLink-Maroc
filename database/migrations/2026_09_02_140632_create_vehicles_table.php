<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transporteur_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('type');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('registration_number')->unique();

            $table->decimal('capacity', 10, 2);
            $table->boolean('available')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};