<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\LeaveRequest;    
use App\Rules\MaxTenHoursRule;
use App\Models\Project;
use App\Models\WorkReport;
use App\Concerns\common;
use App\Rules\NoLeaveOnDate;

class WorkReportController extends Controller
{
    use common;
    //
    public function show(){
        
        $projects=Project::All();
        $tasks=WorkReport::with(['project', 'employee'])->where('employee_id','=',auth()->id())->paginate(10);
        return view("pages::workreports.work-report", compact('projects','tasks'));
    }

    public function addTask(Request $request) {
        $reportDate = $request->input('work_report_date'); 
        $employeeId = auth()->id(); 
        // Proceed to save the work report // ... logic to save to work_reports table
        try {
            $validate = $request->validate([
                'work_report_date' => [
                    'required', 
                    'date', 
                    'before_or_equal:today', 
                    new NoLeaveOnDate
                ], 
                'project_id' => 'required|exists:projects,id', 
                // 'description' => 'required|string|max:255', 
                'duration_input' => ['required', new MaxTenHoursRule($request->work_report_date)]
            ]);

            $data= \App\Models\WorkReport::create([
                'employee_id' => $employeeId,
                'work_report_date' => $reportDate,
                'project_id' => $request->input('project_id'),
                'duration_minutes' => $this->convertToMinutes($request->input('duration_input')),
                'status' => 'submitted',
            ]);
            if($data) {
                return redirect(route('workreport.showForm'));
            }
        } catch (QueryException $e){
            if($e->getCode()==="23000"); //1062
            return redirect()->back()->withErrors(['message'=>'This Project Already entered today'])->withInput();
            throw $e;
        } catch (Exception $e){
                
        }
    }
}
