<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommonDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('percentage');
            $table->unsignedBigInteger('discount_selling')->nullable();
            $table->unsignedBigInteger('minimal_order_amount')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('common_discounts');
    }
}
