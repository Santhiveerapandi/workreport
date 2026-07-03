<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use App\Models\WorkReport;
use Illuminate\Support\Facades\Auth;

class MaxTenHoursRule implements ValidationRule
{
    
    protected string $date;
    protected int $minutes; 

    public function __construct(string|NULL $date) 
    { 
        $this->date = ($date==NULL)? date('Y-m-d'): $date; 
    } 
    public function validate(string $attribute, mixed $value, Closure $fail): void { 
        
        // 1. Convert input to minutes 
        $newMinutes = $this->convertToMinutes($value); 
        if ($newMinutes > 600) { 
            $fail('A single task cannot exceed 10 hours.'); return; 
        } 
        
        // 2. Check total for the day if date is provided 
        if ($this->date) { 
            $existingMinutes = WorkReport::where('employee_id', "=", Auth::id(), "true") ->where('work_report_date', $this->date) ->sum('duration_minutes'); 
            if (($existingMinutes + $newMinutes) > 600) { 
                $fail('The total duration for this date cannot exceed 10 hours.'); 
            } 
        } 

        $this->minutes  = $newMinutes;
    } 
    public function convertToMinutes(string $timeInput): int
    { 
        if (str_contains($timeInput, ':')) { 
            [$hours, $minutes] = explode(':', $timeInput); 
            return ($hours * 60) + (int)$minutes; 
        } 
        return (int)($timeInput * 60); 
    } 
}
