<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SalaryController extends Controller
{
    //
    public function AddAdvanceSalary(){

        $employee = Employee::latest()->get();
        return view('backend.salary.add_advance_salary', compact('employee'));
    }

    public function AdvanceSalaryStore(Request $request){

        $validateData = $request->validate([
            'month' => 'required',
            'year' => 'required',
            'advance_salary' => 'required|max:255'
        ]);

        $month = $request->month;
        $employee_id = $request->employee_id;

        $advanced = AdvanceSalary::where('month',$month)->where('employee_id',$employee_id)->first();

        if ($advanced === NULL) {
            # code...
            AdvanceSalary::insert([
                'employee_id' => $request->employee_id,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Advance Salary Paid succesfully',
                'alert-type' => 'success',
            );
            
            return redirect()->back()->with($notification);

        } else {

            $notification = array(
                'message' => 'Advance Salary already paid',
                'alert-type' => 'warning',
            );
            
            return redirect()->back()->with($notification);
        }
        
    }

    public function AllAdvanceSalary(){

        $salary = AdvanceSalary::latest()->get();
        return view('backend.salary.all_advance_salary', compact('salary'));
    }
}
