<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->integer('team_id');
            $table->boolean('is_open')->default(true);
            $table->bigInteger('linked_ticket_id')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->json('pms')->nullable();
            $table->json('properties')->nullable();
            $table->json('agencies')->nullable();
            $table->json('tenants')->nullable();
            $table->json('owners')->nullable();
            $table->json('tradies')->nullable();
            $table->json('snapshot')->nullable();
            $table->json('tasks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
