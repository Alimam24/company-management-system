<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Person;
use App\Models\department;
use App\Models\emp_state;
use App\Models\emp_role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Person::class)->unique();
            $table->foreignIdFor(department::class);
            $table->nullableMorphs('assignable');
            $table->foreignIdFor(emp_state::class)->default(1);
            $table->foreignIdFor(emp_role::class)->default(1);


            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
