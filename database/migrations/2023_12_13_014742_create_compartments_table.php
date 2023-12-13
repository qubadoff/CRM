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
        Schema::create('compartments', function (Blueprint $table) {
            $table->id();
            $table->integer("uuid")->nullable();
            $table->text("name");
            $table->text("category");
            $table->text("voen");
            $table->integer("employee_count");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compartments');
    }
};
