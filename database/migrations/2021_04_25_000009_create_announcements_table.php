<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            // $table->uuid('id')->primary();
            $table->id();
            // $table
            //     ->foreignUuid('activity_id')
            //     ->constrained('activities')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            $table
                ->foreignId('activity_id')
                ->constrained('activities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('publish_date');
            // $table
            //     ->foreignUuid('publisher')
            //     ->constrained('users')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            $table->string('note');
            $table
                ->foreignId('publisher')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('announcements');
    }
}
