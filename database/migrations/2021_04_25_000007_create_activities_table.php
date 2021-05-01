<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            // $table->uuid('id')->primary();
            $table->id();
            $table
                ->foreignId('activity_type_id')
                ->constrained('activity_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->year('school_year');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('note');
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
        Schema::dropIfExists('activities');
    }
}
