<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compare_product', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Market\Product::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Market\Compare::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->primary(['product_id', 'compare_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compare_product');
    }
};
