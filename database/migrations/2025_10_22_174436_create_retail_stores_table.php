<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\city;
use App\Models\employee;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('retail_stores', function (Blueprint $table) {
            $table->id();
            $table->string("StoreName");
            $table->foreignIdFor(city::class);
            $table->string("Address");
            $table->string("Phone");
            $table->foreignIdFor(employee::class, 'manager_id')->nullable();
            $table->string("Brochure_url")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_stores');
    }
};
