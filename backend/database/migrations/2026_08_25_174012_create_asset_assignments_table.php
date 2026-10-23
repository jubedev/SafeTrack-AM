<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asset_assignments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignUuid('employee_id')->nullable()->constrained('users');
            $table->foreignUuid('workstation_id')->nullable()->constrained('workstations');
            $table->foreignUuid('assigned_by_id')->nullable()->constrained('users');
            $table->foreignUuid('asset_id')->constrained('assets');

            $table->string('status')->default('activo');
            $table->text('notes_on_delivery')->nullable();
            $table->text('notes_on_return')->nullable();
            $table->string('signature_path')->nullable();

            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamp('returned_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['company_id', 'assigned_at']);
            $table->index(['company_id', 'returned_at']);
            $table->index(['company_id', 'status']);
        });

        DB::statement('
            CREATE UNIQUE INDEX asset_assignments_one_open_per_asset
            ON asset_assignments (asset_id)
            WHERE returned_at IS NULL AND deleted_at IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS asset_assignments_one_open_per_asset');
        Schema::dropIfExists('asset_assignments');
    }
};
