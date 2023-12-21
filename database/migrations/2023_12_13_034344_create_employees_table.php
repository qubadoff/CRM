<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\SexEnum;
use App\Enums\EducationEnum;
use App\Enums\JobTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('compartment_id');
            $table->integer('department_id');
            $table->integer('position_id');
            $table->integer('geometric_card_number')->nullable();
            $table->text('full_name');
            $table->text('father_name');
            $table->string("id_number");
            $table->string("id_pin_number");
            $table->dateTime('birthday');
            $table->tinyInteger('sex')->default(
                SexEnum::MALE->value
            );
            $table->text("location");
            $table->mediumText("other_information")->nullable();
            $table->string("email")->nullable();
            $table->string("phone");
            $table->tinyInteger("education")->default(
                EducationEnum::UNEDUCATED->value
            );
            $table->text("school_name")->nullable();
            $table->integer("experience")->nullable();
            $table->tinyInteger("job_type")->default(
                JobTypeEnum::FULL_TIME->value
            );
            $table->integer("work_time");
            $table->date("hired_date");
            $table->time("start_time");
            $table->time("end_time");
            $table->string("reference")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
