<?php

namespace App\Concerns;

trait common
{
    //Workreport Submit Rules
    protected function passwordRules(): array
    {
        return ['required', 'string', Password::default(), 'confirmed'];
    }

    //Converting Minutes
    protected function convertToMinutes(string $timeInput): int
    { 
        if (str_contains($timeInput, ':')) { 
            [$hours, $minutes] = explode(':', $timeInput); 
            return ($hours * 60) + (int)$minutes; 
        } 
        return (int)($timeInput * 60); 
    }
}
