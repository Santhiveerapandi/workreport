<?php

namespace App\View\Components;

use Closure;
// use Illuminate\Contracts\View\View;
// use Illuminate\View\Component;


use Livewire\Component; 
use App\Livewire\Forms\TaskForm; 
use App\Models\WorkReport; 
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Concerns\common;

class WorkReportManager extends Component
{
    use common;
    public TaskForm $form; 
    public array $tasks = []; 
    
    public function addTask(\App\Actions\AddTask $action) { 
        
        $this->form->validate();
        $employeeId = auth()->id();
        // Convert duration_input to minutes here... 
        $minutes = $this->parseDuration($this->form->duration_input); 
        
        $action->create(['employee_id' => $employeeId, 'project_id' => $this->form->project_id, 'duration_minutes' => $minutes, 'work_report_date' => $this->form->work_report_date]);
        $this->form->reset(['project_id', 'description', 'duration_input']);
        session()->flash('success', 'Reports submitted!');
    } 

    public function saveAll() { 
        DB::transaction(function () { 
        foreach ($this->tasks as $task) { 
            WorkReport::create($task); 
        } 
        }); 
        $this->tasks = []; 
        session()->flash('success', 'Reports submitted!'); 
    } 
    
    private function parseDuration($input) { 
        return $this->convertToMinutes($input); 
    }
}
