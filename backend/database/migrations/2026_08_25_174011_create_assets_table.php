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
            $table->uuid('id')->primary();
            $table->foreignUuid('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignUuid('category_id')->constrained('categories')->restrictOnDelete();

            // Identificación Básica
            $table->string('name');
            $table->string('brand');
            $table->string('model')->nullable();
            $table->string('serial_number');
            $table->string('asset_tag');

            // ESPECIFICACIONES TÉCNICAS (Estructura dinámica en JSON)
            $table->json('specifications')->nullable();

            // Estado y Ubicación
            $table->string('status')->default('disponible');
            $table->string('location')->nullable()->default('Bodega Principal');

            // Datos Financieros y Garantía
            $table->date('purchase_date')->nullable();
            $table->date('warranty_expiration')->nullable();
            $table->decimal('cost', 12, 2)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['company_id', 'serial_number']);
            $table->unique(['company_id', 'asset_tag']);
            $table->index(['company_id', 'status']);
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
