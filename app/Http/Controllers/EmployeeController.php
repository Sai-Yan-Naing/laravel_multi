<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function listEmployee()
    {
        $employees = Employee::paginate(1);
        return view('admin.employee.index',compact('employees'));
    }
    public function createEmployee()
    {
        $companies = Company::all();
        return view('admin.employee.create',compact('companies'));
    }
    public function storeEmployee(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name'              => 'required|string|max:255',
            'last_name'              => 'required|string|max:255',
            'staffid'              => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:employees',
            'phone'              => 'required|string|max:255',
            'department'              => 'required|string|max:255',
            'password'          => 'required|string|min:8',
            'address'            => 'required|string',
        ]);
        $employee = Employee::create([
            'first_name'      => $request->first_name,
            'last_name'      => $request->last_name,
            'staffid'      => $request->staffid,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'company_id'     => $request->company_id,
            'department'     => $request->department,
            'password'  => Hash::make($request->password),
            'address'   => $request->address,
        ]);
        return redirect()->route('listEmployee');
    }

    public function editEmployee($id)
    {
        $companies = Company::all();
        $employee = Employee::find($id);
        return view('admin.employee.edit',compact('employee','companies'));
    }

    public function updateEmployee(Request $request,$id)
    {
        $employee = Employee::findOrFail($id);
        // dd($request->all());
        $request->validate([
            'first_name'              => 'required|string|max:255',
            'last_name'              => 'required|string|max:255',
            'staffid'              => 'required|string|max:255',
            'email'             => [
                                    'required','string','email','max:255',
                                    Rule::unique('employees')->ignore($employee->id,'id')
                                ],
            'phone'              => 'required|string|max:255',
            'department'              => 'required|string|max:255',
            'password'          => 'required|string|min:8',
            'address'            => 'required|string',
        ]);

        $employee->update([
            'first_name'      => $request->first_name,
            'last_name'      => $request->last_name,
            'staffid'      => $request->staffid,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'company_id'     => $request->company_id,
            'department'     => $request->department,
            'password'  => Hash::make($request->password),
            'address'   => $request->address,
        ]);
        return redirect()->route('listEmployee');
    }
    public function deleteEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('listEmployee');
    }
}
