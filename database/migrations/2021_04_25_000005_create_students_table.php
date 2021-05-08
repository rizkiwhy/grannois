<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            // $table->uuid('id')->primary();
            $table->id();
            $table
                ->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade')->unique();
            // $table
            //     ->foreignUuid('user_id')
            //     ->nullable()
            //     ->constrained('users');
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('student_parent_number')->nullable();
            $table->string('national_student_parent_number')->nullable();
            $table->uuid('origin_school_id')->nullable();
            $table
                ->foreignId('competency_of_expertise_id')
                ->nullable()
                ->constrained('competency_of_expertises')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
