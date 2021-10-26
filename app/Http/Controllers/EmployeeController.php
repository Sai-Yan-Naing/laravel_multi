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
        $employees = Employee::paginate(10);
        return view('admin.employee.index',compact('employees'));
    }
    public function eListEmployee()
    {
        $employees = Employee::paginate(10);
        return view('employee.employee.index',compact('employees'));
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
            'staffid'              => [
                'required','string','max:255',
                Rule::unique('employees','staffid')
                ->where(function ($query) use ($request) {
                    $query->where('company_id', $request->company_id);
                }),
            ],
            'email'             => [
                'required','string','max:255','email',
                Rule::unique('employees','email')
                ->where(function ($query) use ($request) {
                    $query->where('company_id', $request->company_id);
                }),
            ],
            'phone'              => 'required|string|max:255',
            'company_id'              => 'required',
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
        // dd($request->company_id);
        $request->validate([
            'first_name'              => 'required|string|max:255',
            'last_name'              => 'required|string|max:255',
            'staffid'              => [
                                    'required','string','max:255',
                                    Rule::unique('employees','staffid')
                                    ->where(function ($query) use ($request) {
                                        $query->where('company_id', $request->company_id);
                                    })
                                    ->ignore($employee->id,'id'),
                                ],
            'email'             => [
                                        'required','string','max:255','email',
                                        Rule::unique('employees','email')
                                        ->where(function ($query) use ($request) {
                                            $query->where('company_id', $request->company_id);
                                        })
                                        ->ignore($employee->id,'id'),
                                    ],
            'phone'              => 'required|string|max:255',
            'company_id'              => 'required',
            'department'              => 'required|string|max:255',
            'password'          => 'nullable|string|min:8',
            'address'            => 'required|string',
        ]);

        $employee->update($request->only('first_name','last_name','staffid','email','phone','company_id','department','address'));

        if($request->filled('password')){
            $employee->update($request->only('password'));
        }
        return redirect()->route('listEmployee');
    }
    public function deleteEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('listEmployee');
    }
}
