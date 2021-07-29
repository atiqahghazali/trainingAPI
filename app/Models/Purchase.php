<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'house_id',
        'amount',
        'toyyibpay_bill_code',
        'payment_status'
    ];

    public function getRealAmountAttribute()
    {
        return 'RM'.$this->amount/100;
    }

    public function getPaymentLinkAttribute()
    {
        return 'https://dev.toyyibpay.com/'.$this->toyyibpay_bill_code;
    }
}
