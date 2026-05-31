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
        Schema::table('bookings', function (Blueprint $table) {
           // Change room_id to unsignedBigInteger to match rooms.id
           $table->unsignedBigInteger('room_id')->nullable()->change();

           // Add the foreign key with cascade on delete
           $table->foreign('room_id')
                 ->references('id')
                 ->on('rooms')
                 ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the foreign key
            $table->dropForeign(['room_id']);

            // Revert room_id back to string if necessary
            $table->string('room_id')->nullable()->change();
        });
    }
};
