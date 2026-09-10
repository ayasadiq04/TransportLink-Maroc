<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Supprime la table reviews (fonctionnalité supprimée du projet).
     */
    public function up(): void
    {
        Schema::dropIfExists('reviews');
    }

    public function down(): void
    {
        //
    }
};