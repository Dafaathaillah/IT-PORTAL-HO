<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('daily_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->enum('category_job', ['assignment', 'unschedule']);
            $table->text('description')->nullable();
            $table->string('site');
            $table->string('category');
            $table->enum('shift', ['pagi', 'malam']);
            $table->date('date');
            $table->datetime('start_progress')->nullable();
            $table->datetime('end_progress')->nullable();
            $table->text('issue')->nullable();
            $table->text('root_cause')->nullable();
            $table->text('action_taken')->nullable();
            $table->text('remark')->nullable();
            $table->enum('status', ['open', 'continue', 'closed', 'outstanding', 'cancel'])->default('open');
            $table->enum('urgency', ['low', 'medium', 'high'])->default('medium');
            $table->json('crew')->nullable(); // Stores array of user IDs
            $table->string('sarana')->nullable(); // Previously 'sarana'
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();

            $table->index(['date', 'shift']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
