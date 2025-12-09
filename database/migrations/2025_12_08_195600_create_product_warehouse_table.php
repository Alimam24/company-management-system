<?php

use App\Models\product;
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
        Schema::create('product_warehouse', function (Blueprint $table) {
            $table->foreignIdFor(warehouse::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(product::class)->constrained()->onDelete('cascade');
            $table->unsignedInteger('amount')->default(0);
            $table->timestamps();
            $table->unique(['warehouse_id', 'product_id'], 'product_warehouse_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_warehouse');
    }
};
