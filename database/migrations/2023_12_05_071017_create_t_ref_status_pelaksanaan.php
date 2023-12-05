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
        Schema::create('t_ref_status_pelaksanaan', function (Blueprint $table) {
            $table->id();
            $table->string('status_pelaksanaan')->nullable();
            $table->string('ur_status_pelaksanaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_ref_status_pelaksanaan');
    }
};
