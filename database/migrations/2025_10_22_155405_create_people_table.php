<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use App\Models\customer_type;
use App\Models\emp_state;
use App\Models\department;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string("FirstName");
            $table->string("LastName");
            $table->string("NationalId");
            $table->string("email")->unique();
            $table->string('phone_num')->nullable();
            $table->date("BirthDate");
            $table->string('avatar_url')->default('resources/images/profile.png');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
