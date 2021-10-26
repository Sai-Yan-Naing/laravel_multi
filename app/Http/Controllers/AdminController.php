<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Exports\EmployeeExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter;
        // if($filter != null)
        // {
            $employees = Employee::
            where ( 'staffid', 'LIKE', '%' . $filter . '%' )
            ->orwhere ( function($query) use ($filter) {
                $query->Where(DB::raw('CONCAT(first_name," ",last_name)'), 'LIKE', '%' . $filter . '%');
            } )
            ->orwhere ( 'department', 'LIKE', '%' . $filter . '%' )
            ->orwhereHas('company', function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->filter}%");
            })
            ->paginate(10);
        // }else{
        //     $employees = Employee::paginate(10);
        // }
        return view('admin.dashboard.index',compact('employees','filter'));
    }

    public function employeeDashboard(Request $request)
    {
        $filter = $request->filter;
        // if($filter != null)
        // {
            $employees = Employee::
            where('company_id',auth()->user()->company_id)
            ->where ( 'staffid', 'LIKE', '%' . $filter . '%' )
            ->where ( function($query) use ($filter) {
                $query->Where(DB::raw('CONCAT(first_name," ",last_name)'), 'LIKE', '%' . $filter . '%');
            } )
            ->where ( 'department', 'LIKE', '%' . $filter . '%' )
            ->whereHas('company', function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->filter}%");
            })
            ->paginate(10);
        // }else{
        //     $employees = Employee::paginate(10);
        // }
        return view('employee.dashboard.index',compact('employees','filter'));
    }
    public function export(Request $request)
    {
        // return $request->filter;
        return Excel::download(new EmployeeExport($request->filter), 'employee.csv');
    }

    public function editEmployee($id)
    {
        $companies = Company::all();
        $employee = Employee::find($id);
        return view('admin.dashboard.edit',compact('employee','companies'));
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
        return redirect()->route('dashboard');
    }

    public function deleteEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('dashboard');
    }

}
