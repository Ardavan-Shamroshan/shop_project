<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('address_object')->nullable();
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('payment_object')->nullable();
            $table->tinyInteger('payment_type')->default(0)->comment('0 => آنلاین, 1 => آفلاین, 2 => در محل,');
            $table->tinyInteger('payment_status')->default(0)->comment('0 => پرداخت نشده, 1 => پرداخت شده, 2 => باطل شده, 3 => برگشت داده شده');
            $table->foreignId('delivery_id')->nullable()->constrained('delivery')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('delivery_object')->nullable();
            $table->decimal('delivery_amount', 20, 3)->nullable();
            $table->tinyInteger('delivery_status')->default(0)->comment('0 => ,ارسال نشده 1 => درحال ارسال, 2 => ارسال شده, 3 => تحویل شده,');
            $table->timestamp('delivery_date')->nullable();
            $table->decimal('order_final_amount', 20, 3)->nullable();
            $table->decimal('order_discount_amount', 20, 3)->nullable();
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('coupon_object')->nullable();
            $table->decimal('order_coupon_discount_amount', 20, 3)->nullable();
            $table->foreignId('common_discount_id')->nullable()->constrained('common_discounts')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('common_discount_object')->nullable();
            $table->decimal('order_common_discount_amount', 20, 3)->nullable();
            $table->decimal('order_total_products_discount_amount', 20, 3)->nullable();
            $table->tinyInteger('order_status')->default(0)->comment('0 => در انتظار تایید, 1 => تایید شده, 2 => تایید نشده, 4 =>باطل شده 4 => مرجوع شده,');
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
        Schema::dropIfExists('orders');
    }
}
