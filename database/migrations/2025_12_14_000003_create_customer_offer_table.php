<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\customer;
use App\Models\Offer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_offer', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(customer::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Offer::class)->constrained()->cascadeOnDelete();
            $table->date('AssignedDate')->default(now());
            $table->timestamps();
            
            // Ensure a customer can't have the same offer twice
            $table->unique(['customer_id', 'offer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_offer');
    }
};

