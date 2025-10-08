<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EmployeeController extends Controller
{
    //
    public function AllEmployee(){

        $employee = Employee::latest()->get();
        return view('backend.employee.all_employee', compact('employee'));
    }

    public function AddEmployee(){
        return view('backend.employee.add_employee');
    }

    public function StoreEmployee(Request $request){

        $validateData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:employees|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'salary' => 'required|max:200',
            'vacation' => 'required|max:200',
            'experience' => 'required',
            'image' => 'required',
        ],

        [
            'name.required' => 'This Employee Name Field Is Required',
        ]
    
    );

        $image = $request->file('image');

        if ($image) {
            
            $manager = new ImageManager(new Driver());
            
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            
            $manager->read($image)->resize(300, 300)->save(public_path('upload/employee/' . $name_gen));
            
            $save_url = 'upload/employee/' . $name_gen;
        
        } else {
            $save_url = null;
        }

        Employee::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Employee created succesfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.employee')->with($notification);
    }

    public function EditEmployee($id){

        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit_employee', compact('employee'));
    }

    public function UpdateEmployee(Request $request){

        $employee_id = $request->id;
        $employee = Employee::findOrFail($employee_id);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,
            'updated_at' => Carbon::now(),
        ];

        if ($request->file('image')) {

            $image = $request->file('image');
            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            // Delete old image if exists
            if ($employee->image && file_exists(public_path($employee->image))) {
                unlink(public_path($employee->image));
            }

            $manager->read($image)->resize(300, 300)->save(public_path('upload/employee/' . $name_gen));

            $data['image'] = 'upload/employee/' . $name_gen;
        }
        
        $employee->update($data);
        
        $notification = [
            'message' => $request->file('image') ? 'Employee data updated with new image successfully' : 'Employee data updated without image successfully',
            'alert-type' => 'success',
        ];
        
        return redirect()->route('all.employee')->with($notification);
    }

    public function DeleteEmployee($id){

        $employee_img = Employee::findOrFail($id);
        $img = $employee_img->image;
        unlink($img);

        Employee::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Employee deleted succesfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

}
