<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class WorkReport extends Model
{
    protected $fillable = ['employee_id', 'work_report_date', 'project_id', 'duration_minutes', 'task_description'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function employee(): BelongsTo
    {
        // The 2nd argument is the foreign key on work_reports
        // The 3rd argument is the owner key on the employees table
        // return $this->belongsTo(Employee::class, 'employee_id');
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    // $this->belongsTo(Employee::class, 'employee_id', 'custom_id_column');
}
