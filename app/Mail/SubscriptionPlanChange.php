<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionPlanChange extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $plan;
    public $endDate;
    public $amount;
    public $previousPlan;

    public function __construct($user, $plan, $endDate, $amount, $previousPlan = null)
    {
        $this->user = $user;
        $this->plan = $plan;
        $this->endDate = $endDate;
        $this->amount = $amount;
        $this->previousPlan = $previousPlan;
    }

    public function build() 
    {
         if ($this->plan === 'basic') {
        return $this->subject("Welcome to {$this->plan} – Your Upgrade Is Complete!")
            ->view('emails.subscription_plan_basic_change');
    } elseif ($this->plan === 'pro') {
        return $this->subject("Welcome to {$this->plan} – Your Upgrade Is Complete!")
            ->view('emails.subscription_plan_pro_change');
    } elseif ($this->plan === 'expert') {
        return $this->subject("Welcome to {$this->plan} – Your Upgrade Is Complete!")
            ->view('emails.subscription_plan_expert_change');
    }
    }
}
