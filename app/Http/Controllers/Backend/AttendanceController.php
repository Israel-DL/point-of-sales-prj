<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //
    public function EmployeeAttendanceList(){

        $allData = Attendance::select('date')->groupBy('date')->orderBy('id', 'desc')->get();
        return view('backend.attendance.view_employee_attendance', compact('allData'));
    }

    public function AddEmployeeAttendance(){
        
        $employees = Employee::all();
        return view('backend.attendance.add_employee_attendance', compact('employees'));
    }

    public function EmployeeAttendanceStore(Request $request){

        $countemployee = count($request->employee_id);

        for ($i=0; $i < $countemployee ; $i++) { 
            # code...
            $attendance_status = 'attendance_status'.$i;
            $attendance = new Attendance();
            $attendance->date = date('Y-m-d',strtotime($request->date));
            $attendance->employee_id = $request->employee_id[$i];
            $attendance->attendance_status = $request->$attendance_status;
            $attendance->save();
        }

        $notification = array(
            'message' => 'Date inserted succesfully',
            'alert-type' => 'success',
        );

        return redirect()->route('employee.attendance.list')->with($notification);
    }
}
