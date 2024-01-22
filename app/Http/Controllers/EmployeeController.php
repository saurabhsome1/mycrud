<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use App\Models\Employee;
class EmployeeController extends Controller
{
    public function index() {

        $employee = Employee::orderBy('id','DESC')->paginate(5);

        return view('employee.list',['employee' => $employee]);
    }
    public function create() {
        return view('employee.create');
    }
    public function store(Request $request) {
        $validator = validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:gif,png.jpeg,jpg'
        ]);

        if ( $validator->passes() ) {
            // save data here

            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->save();

            if($request->image) {
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/employee/',$newFileName); //this will save file inn folder
                $employee->image = $newFileName;
                $employee->save();
            }

            $request->session()->flash('success','Employee added successfully');

            return redirect()->route('employee.index')->with('success','Employee deleted successfully');


        } else {
            //return with error 

            return redirect()->route('employee.create')->withErrors($validator)->withInput();
        }

    }

    public function edit($id) {
        $employee = Employee::findOrFail($id);

        return view('employee.edit',['employee'=>$employee]);
    }
    public function update($id, Request $request) {
    
            $validator = validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
                'image' => 'sometimes|image:gif,png.jpeg,jpg'
            ]);
    
            if ( $validator->passes() ) {
                // save data here
    
                $employee =  Employee::find($id);
                $employee->name = $request->name;
                $employee->email = $request->email;
                $employee->address = $request->address;
                $employee->save();
                
                // Upload image here
                if($request->image) {
                    $oldImage = $employee->image;

                    $ext = $request->image->getClientOriginalExtension();
                    $newFileName = time().'.'.$ext;
                    $request->image->move(public_path().'/uploads/employee/',$newFileName); //this will save file inn folder
                    $employee->image = $newFileName;
                    $employee->save();

                     File::delete(public_path().'/uploads/employee/'.$oldImage);

                }
    
    
                return redirect()->route('employee.index')->with('success','Employee updated successfully');
    
    
            } else {
                //return with error 
    
                return redirect()->route('employee.edit',$id)->withErrors($validator)->withInput();
            }
    

    }
    public function destroy($id, Request $request) {
        $employee = Employee::findOrFail($id);

        File::delete(public_path().'/uploads/employee/'.$employee->image);
        $employee->delete();

        return redirect()->route('employee.index')->with('success','Employee deleted successfully');
    }
}
