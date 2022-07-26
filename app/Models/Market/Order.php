<?php

namespace App\Models\Market;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    public function delivery() {
        return $this->belongsTo(Delivery::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function address() {
        return $this->belongsTo(Address::class);
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }

    public function commonDiscount() {
        return $this->belongsTo(CommonDiscount::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function getPaymentStatusValueAttribute() {
        switch ($this->payment_stauts) {
            case 0:
                $result = 'پرداخت نشده';
                break;
            case 1:
                $result = 'پرداخت شده';
                break;
            case 2:
                $result = 'باطل شده';
                break;
            default:
                $result = 'برگشت داده شده';
                break;
        }
        return $result;
    }

    public function getPaymentTypeValueAttribute() {
        switch ($this->payment_type) {
            case 0:
                $result = 'آنلاین';
                break;
            case 1:
                $result = 'آفلاین';
                break;
            default:
                $result = 'در محل';
                break;
        }
        return $result;
    }

    public function getDeliveryStatusValueAttribute() {
        switch ($this->delivery_status) {
            case 0:
                $result = 'ارسال نشده';
                break;
            case 1:
                $result = 'درحال ارسال';
                break;
            case 2:
                $result = 'ارسال شده';
                break;
            default:
                $result = 'تحویل شده';
                break;
        }
        return $result;
    }

    public function getOrderStatusValueAttribute() {
        switch ($this->order_status) {
            case 0:
                $result = 'در انتظار تایید';
                break;
            case 1:
                $result = 'تایید شده';
                break;
            case 2:
                $result = 'تایید نشده';
                break;
            case 3:
                $result = 'باطل شده';
                break;
            default:
                $result = 'مرجوع شده';
        }
        return $result;
    }
}
