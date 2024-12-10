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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->text('image')->nullable();
            $table->string('gender');
            $table->string('birth');
            $table->string('group');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->integer('phone')->unique();
            $table->string('email')->unique();
            $table->integer('weight');
            $table->integer('height');
            $table->integer('chest');
            $table->integer('waist');
            $table->integer('thigh');
            $table->integer('arm');
            $table->integer('fat');
            $table->string('staff_member');
            $table->foreignId('membership')->constrained('memberships');
            $table->string('start_date');
            $table->string('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
