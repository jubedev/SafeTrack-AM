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
        Schema::create('sub_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_asset_id')->constrained('assets')->cascadeOnDelete();
            $table->string('internal_code')->unique();
            $table->string('serial_number')->unique();
            $table->string('qr_code')->unique();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->text('notes')->nullable();
            $table->jsonb('specifications')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_assets');
    }
};
