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
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Assuming 'name' is a string. Adjust the type if necessary.
            $table->string('email')->unique();
            $table->string('password');
            $table->string('employee_id'); // Assuming 'employee' is a string. Adjust the type if necessary.
            $table->string('phonenumber'); // Assuming 'phonenumber' is a string. Adjust the type if necessary.
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managers');
    }
};
