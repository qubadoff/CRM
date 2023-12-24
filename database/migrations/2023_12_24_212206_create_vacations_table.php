<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\VacationStatusEnum;
use App\Enums\VacationTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            $table->integer('compartment_id');
            $table->integer('department_id');
            $table->integer('user_id');
            $table->datetimes('vacation_date');
            $table->tinyInteger('status')->default(VacationStatusEnum::PENDING->value);
            $table->tinyInteger('type')->default(VacationTypeEnum::WITHOUT_PERMISSION->value);
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacations');
    }
};
