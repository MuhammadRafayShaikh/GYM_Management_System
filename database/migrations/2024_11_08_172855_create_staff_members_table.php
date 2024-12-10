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
        Schema::create('staff_members', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->text('image')->nullable();
            $table->string('gender');
            $table->string('birth');
            $table->string('role');
            $table->string('specialization');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->integer('phone')->unique();
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_members');
    }
};
