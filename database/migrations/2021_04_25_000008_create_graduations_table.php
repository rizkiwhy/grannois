<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraduationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduations', function (Blueprint $table) {
            // $table->uuid('id')->primary();
            $table->id();
            // $table
            //     ->foreignUuid('activity_id')
            //     ->constrained('activities')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            // $table
            //     ->foreignUuid('student_id')
            //     ->constrained('students')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            $table
                ->foreignId('activity_id')
                ->constrained('activities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('student_id')
                ->constrained('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('status');
            $table->string('certificate');
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
        Schema::dropIfExists('graduations');
    }
}
