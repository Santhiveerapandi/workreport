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
use Illuminate\Support\Facades\Validator;
use Throwable;
use Illuminate\Support\Facades\Gate;

class WorkReportController extends Controller
{
    use common;
    protected $gate;

    public function __construct(
        Gate $gate
    ) {
        $this->gate = $gate;
    }

    public function show(){
        if (!$this->gate::allows('workreport_view')) {
            abort(403);
        }
        $projects=Project::All();
        $tasks=WorkReport::with(['project', 'employee'])->where('employee_id','=',auth()->id())->paginate(10);
        return view("pages::workreports.work-report", compact('projects','tasks'));
    }

    public function addTask(Request $request) {
        if (!$this->gate::allows('workreport_create')) {
            abort(403);
        }
        $reportDate = $request->input('work_report_date'); 
        $employeeId = auth()->id(); 
        // Proceed to save the work report // ... logic to save to work_reports table
        try {

            $validator = Validator::make($request->all(), [
                'work_report_date' => [
                    'required', 
                    'date', 
                    'before_or_equal:today', 
                    new NoLeaveOnDate
                ], 
                'project_id' => 'required|exists:projects,id', 
                'task_description' => 'required|string|max:255', 
                'duration_input' => ['required', new MaxTenHoursRule($request->input('work_report_date'))]
            ]);

            if ($validator->fails()) {
                return redirect(route('workreport.showForm'))
                    ->withErrors($validator)
                    ->withInput();
            }
            $data= \App\Models\WorkReport::create([
                'employee_id' => $employeeId,
                'work_report_date' => $reportDate,
                'project_id' => $request->input('project_id'),
                'task_description' => $request->input('task_description'),
                'duration_minutes' => $this->convertToMinutes($request->input('duration_input')),
                'status' => 'submitted',
            ]);
            if($data) {
                return redirect()
                ->route('workreport.showForm')
                ->with('success', 'Your work report was submitted successfully!');    
            }
        } catch (QueryException $e){
            if($e->getCode()==="23000");
            return redirect()->back()->withErrors(['message'=>'This Project Already entered today'])->withInput();
            throw $e;
        } catch (Throwable $e){
            return redirect()->back()->withErrors(['error'=>$e->getCode(), 'message'=>$e->getMessage()])->withInput();
        }
    }

    public function view(string $id) {
        if (!$this->gate::allows('workreport_view')) {
            abort(403);
        }
        try {
            
            if ($this->isAdmin()) {
                $workreport= WorkReport::with(['project', 'employee'])
                ->where('id','=',$id)->first();
            } elseif ($this->isUser()) {
                $workreport= WorkReport::with(['project', 'employee'])
                ->where('employee_id','=',auth()->id())->where('id','=',$id)->first();
            } else {
                abort(403);
            }
            return view("pages::workreports.show", ['workreport'=> $workreport]);
        } catch (throwable $e){
            return response()->json(['message'=>$e->getMessage(), 'error_code'=>$e->getCode(), 'status'=>false]);
        }
        
    }

    public function destroy($id) {
        if (!$this->gate::allows('workreport_delete')) {
            abort(403);
        }
        try{
            if ($this->isAdmin()) {
                if((new WorkReport)->destroy($id))
                    return redirect()
                    ->route('workreport.showForm')
                    ->with('success', 'Your work report was deleted successfully!');
            } elseif($this->isUser()) {
                if((new WorkReport)->where('employee_id', '=', auth()->id())->destroy($id))
                    return redirect()
                    ->route('workreport.showForm')
                    ->with('success', 'Your work report was deleted successfully!');
            }
            
        } catch (Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 404);
        }
    }


    
    private function isAdmin()
    {
        if (auth()->user()->hasRole('SuperAdmin') || 
                auth()->user()->hasRole('Admin')) {
            return true;        
        } 
        return false;   
    }

    private function isUser()
    {
        if (auth()->user()->hasRole('GeneralUser')) {
            return true;        
        } 
        return false;
        
    }
}
