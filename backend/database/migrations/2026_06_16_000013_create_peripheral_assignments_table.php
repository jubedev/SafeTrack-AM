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
        Schema::create('peripheral_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peripheral_type_id')->constrained('peripheral_types')->cascadeOnDelete();
            $table->foreignId('workstation_id')->nullable()->constrained('workstations')->nullOnDelete();
            $table->integer('quantity')->default(1);
            $table->string('status')->default('active');
            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peripheral_assignments');
    }
};
