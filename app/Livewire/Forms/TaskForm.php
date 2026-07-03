<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Rules\MaxTenHoursRule;
use App\Rules\NoLeaveOnDate;

class TaskForm extends Form
{
    # [Validate]
    public $work_report_date = '';
    # [Validate]
    public $project_id = '';
    # [Validate]
    // public $description = '';
    # [Validate]
    public $duration_input = '';

    public function rules()
    {
        return [
            'work_report_date' => [
                'required', 
                'date', 
                'before_or_equal:today', 
                new NoLeaveOnDate
            ], 
            'project_id' => 'required|exists:projects,id', 
            // 'description' => 'required|string|max:255', 
            'duration_input' => ['required', new MaxTenHoursRule],
        ];
    }
}
