<?php

namespace App\Policies;

use App\Models\QrBasicInfo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QrBasicInfoPolicy
{
   
    public function create(User $user, string $qrType): bool
    {
        // Count the QR codes based on type
        $qrCount = QrBasicInfo::where('userid', $user->id)
            ->where('qrtype', $qrType)
            ->count();
    
        // Determine plan limits
        $limit = match ([$user->plan, $qrType]) {
            ['basic', 'Dynamic'] => 10,
            ['free', 'Static'] => 5,
            ['free', 'Dynamic'] => 5,
            default => null,
        };
    
        Log::info("QR Count: {$qrCount}, Limit: " . ($limit ?? 'Unlimited'));
    
        // Check the limit
        return !isset($limit) || $qrCount < $limit;
    }
   /**
     * Determine if the user can scan a QR code.
     */
    public function scan(User $user): bool
    {
        $user = Auth::user();

        // Plan-based scan limits
        $limits = [
            'free' => 50,
            'basic' => 5000,
            'pro' => 20000,
            'expert' => null, // Unlimited
        ];

        // Get the limit based on user plan
        $limit = $limits[$user->plan] ?? 0;

        // Count current scans
        $scanCount = QrBasicInfo::where('userid', $user->id)->sum('total_scans');

        Log::info("Scan count: {$scanCount}, Limit: " . ($limit ?? 'Unlimited'));

        return !isset($limit) || $scanCount < $limit;

    }
    
}
