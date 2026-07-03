<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Employee;

class UserObserver
{
    //
    public function created(User $user): void
    {
        /* if ($user->hasRole('admin')) {
            return;
        } */
        $this->notifyCreateEmployee($user);
    }

    public function notifyCreateEmployee(User $user): void
    {
        // Implement your notification logic here
        // For example, you can use Laravel's notification system to send an email or push notification
        // You can also log the notification for auditing purposes
        Employee::create([
            'id' => $user->id,
            'employee_id' => $user->id,
            'name' => $user->name,
        ]);
        
    }
}
