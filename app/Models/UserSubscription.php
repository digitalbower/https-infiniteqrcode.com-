<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{

    use HasFactory;
    protected $fillable = [
        'user_id', 'plan_id', 'stripe_customer_id', 'stripe_payment_intent_id',
        'default_payment_method', 'paid_amount', 'plan_interval', 'customer_name',
        'customer_email', 'plan_period_start', 'plan_period_end', 'status', 'receipt_url'
    ];
}
