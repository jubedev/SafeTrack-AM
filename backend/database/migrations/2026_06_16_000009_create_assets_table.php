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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('internal_code')->unique();
            $table->string('serial_number')->unique();
            $table->string('qr_code')->unique();
            $table->string('brand');
            $table->string('model');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            // Required: physical site/warehouse even when the asset is not at a workstation.
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
            // Nullable: set when operational; null means stored at location_id warehouse.
            // Group/area is resolved via workstation (assignedGroup()), not stored here.
            $table->foreignId('workstation_id')->nullable()->constrained('workstations')->nullOnDelete();
            $table->enum('status', ['available', 'assigned', 'maintenance', 'retired'])->default('available');
            $table->date('purchase_date')->nullable();
            $table->date('warranty_expiration')->nullable();
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
        Schema::dropIfExists('assets');
    }
};