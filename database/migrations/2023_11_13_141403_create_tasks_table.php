<?php

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained();
            $table->unsignedBigInteger('parent_id')->index()->nullable();
            $table->string('title');
            $table->text('description');
            $table->tinyInteger('priority')
                ->index()
                ->default(TaskPriority::LOW->value)
                ->comment('1 .. 5');
            $table->tinyInteger('status')
                ->index()
                ->default(TaskStatus::TODO->value)
                ->comment('0=Todo, 1=Done');
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();

            $table->fullText(['title', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
