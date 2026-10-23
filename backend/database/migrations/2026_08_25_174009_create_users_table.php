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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('company_id')->constrained('companies')->cascadeOnDelete();

            // Datos Personales y de Contacto
            $table->string('document_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();

            // Autenticación y Control de Acceso
            $table->string('password')->nullable(); // Nulo si es empleado sin acceso a la app
            $table->string('role')->default('empleado'); // super_admin, admin, tecnico, empleado
            $table->string('status')->default('activo'); // activo, inactivo

            // Contexto Organizacional
            $table->string('area')->nullable(); // Ej. IT, Operaciones, Formación
            $table->string('position')->nullable(); // Ej. Agente CSR, Team Leader
            $table->string('avatar_path')->nullable(); // Foto de perfil opcional

            $table->timestamps();
            $table->softDeletes();

            // Índices para búsquedas rápidas en el Select del Frontend
            $table->index(['company_id', 'status']);
            $table->unique(['company_id', 'document_number']);

            // Soporte para Laravel Auth
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
