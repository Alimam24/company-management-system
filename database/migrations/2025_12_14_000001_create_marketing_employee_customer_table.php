<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\customer;
use App\Models\employee;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marketing_employee_customer', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(customer::class)->unique()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(employee::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_employee_customer');
    }
};

