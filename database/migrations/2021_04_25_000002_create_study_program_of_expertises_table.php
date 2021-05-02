<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyProgramOfExpertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_program_of_expertises', function (
            Blueprint $table
        ) {
            $table->id();
            $table->string('name');
            $table
                ->foreignId('area_of_expertise_id')
                ->constrained('area_of_expertises')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_program_of_expertises');
    }
}
