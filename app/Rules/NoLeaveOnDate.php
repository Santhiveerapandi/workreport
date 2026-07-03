<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use App\Models\Leave; 
use Illuminate\Support\Facades\Auth;

class NoLeaveOnDate implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void 
    { 
        // Check if a leave exists for the current user on the selected $value (date) 
        $hasLeave = Leave::where('employee_id', Auth::id()) 
            ->whereDate('start_date', '<=', $value) 
            ->whereDate('end_date', '>=', $value) 
            ->exists(); 
    
        if ($hasLeave) { 
            $fail('You have already applied for leave on this date.'); 
        } 
    }
}
