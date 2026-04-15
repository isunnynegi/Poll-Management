<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('poll_id')->constrained('polls')->onDelete('cascade');
            $table->foreignUuid('poll_option_id')->constrained('poll_options')->onDelete('cascade');
            $table->uuid('user_id')->nullable();
            $table->string('voter_ip')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['poll_id', 'user_id']);
            $table->unique(['poll_id', 'voter_ip']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
