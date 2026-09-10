<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Index sur les colonnes fréquemment filtrées et triées.
     */
    public function up(): void
    {
        Schema::table('transport_requests', function (Blueprint $table) {
            $table->index('status');
            $table->index('goods_type');
            $table->index('pickup_at');
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('missions', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->index('available');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropIndex(['available']);
        });

        Schema::table('missions', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('transport_requests', function (Blueprint $table) {
            $table->dropIndex(['pickup_at']);
            $table->dropIndex(['goods_type']);
            $table->dropIndex(['status']);
        });
    }
};