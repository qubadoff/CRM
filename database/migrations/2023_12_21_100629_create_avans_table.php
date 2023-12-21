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
        Schema::create('avans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default('0');
            $table->integer('compartment_id');
            $table->integer('department_id');
            $table->integer('employee_id');
            $table->float('avans_count');
            $table->dateTime('date');
            $table->text('reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avans');
    }
};
