<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\city;
use app\Models\employee;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string("WarehouseName");
            $table->foreignIdFor(employee::class, 'manager_id')->nullable();
            $table->foreignIdFor(City::class);
            $table->string("Address");
            $table->string("Phone");
            $table->string("Brochure_url")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
