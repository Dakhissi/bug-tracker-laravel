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
        // create if it doesn't exist
        if (!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->string('stack_technologies')->nullable();
                $table->json('environments')->nullable();
                $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
                $table->string('status')->default('active'); // e.g., active, completed
                $table->date('deadline')->nullable();
                $table->json('team_members')->nullable();
                $table->unsignedTinyInteger('progress')->default(0); // 0-100
                $table->string('priority')->default('medium'); // low, medium, high
                $table->string('repository_url')->nullable();
                $table->string('documentation_url')->nullable();
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
