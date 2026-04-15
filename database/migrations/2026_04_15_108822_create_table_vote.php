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
        Schema::create('votes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('poll_id')->constrained('polls');
            $table->foreignUuid('poll_option_id')->constrained('poll_options');
            $table->foreignUuid('user_id')->nullable()->constrained('users');
            $table->string('voter_ip')->nullable();
            $table->foreignUuid('created_by');
            $table->foreignUuid('updated_by')->nullable();
            $table->foreignUuid('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['poll_id', 'user_id']);
            $table->unique(['poll_id', 'voter_ip']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
