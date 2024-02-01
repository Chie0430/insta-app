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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 255 charecters
            $table->string('email')->unique();
            $table->longText('avatar')->nullable(); // 1000 charecters
            $table->string('password');
            $table->string('introduction', 100)->nullable(); // seif introduction of users
            $table->unsignedBigInteger('role_id')->default(2)->comment('1:admin 2:user'); // use for making users 1:admin, 2:reguler user
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
