<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetencyOfExpertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competency_of_expertises', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('label')->unique();
            $table
                ->foreignId('study_program_of_expertise_id')
                ->nullable()
                ->constrained('study_program_of_expertises')
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
        Schema::dropIfExists('competency_of_expertises');
    }
}