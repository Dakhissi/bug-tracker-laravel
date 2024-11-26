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
        Schema::create('bugs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects');
            $table->string('title');
            $table->text('description');
            $table->text('steps_to_reproduce');
            $table->text('context')->nullable();
            $table->json('environments')->nullable();
            $table->json('attachments')->nullable();
            $table->text('solution')->nullable();
            $table->string('branch_id')->nullable();
            $table->foreignId('owner_id')->constrained('users');
            $table->foreignId('resolver_id')->nullable()->constrained('users');
            $table->enum('status', ['Open', 'In Progress', 'Solved'])->default('Open');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bugs');
    }
};
