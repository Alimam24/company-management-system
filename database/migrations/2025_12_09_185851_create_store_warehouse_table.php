<?php

use App\Models\retail_store;
use App\Models\warehouse;
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
        Schema::create('store_warehouse', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(retail_store::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(warehouse::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_warehouse');
    }
};
