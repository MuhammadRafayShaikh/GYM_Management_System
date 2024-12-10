<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('attendances', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('member_id');
        $table->unsignedBigInteger('group_id');
        $table->date('attendance_date');
        $table->enum('status', ['present', 'absent'])->default('present'); 
        $table->timestamps();

        $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        
      
        $table->unique(['member_id', 'group_id', 'attendance_date']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            //
        });
    }
};
