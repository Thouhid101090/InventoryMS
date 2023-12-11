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
        Schema::create('return_from_customers', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('customer_id');
        $table->unsignedBigInteger('sale_id')->nullable;
        $table->unsignedBigInteger('product_id');
        $table->integer('quantity');
        $table->decimal('total_amount', 10, 2);
        $table->text('reason')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_from_customers');
    }
};
