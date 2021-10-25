<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Exports\EmployeeExport;
use Illuminate\Http\Request;
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
            ->orwhere ( 'first_name', 'LIKE', '%' . $filter . '%' )
            ->orwhere ( 'last_name', 'LIKE', '%' . $filter . '%' )
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
            where ( 'staffid', 'LIKE', '%' . $filter . '%' )
            ->orwhere ( 'first_name', 'LIKE', '%' . $filter . '%' )
            ->orwhere ( 'last_name', 'LIKE', '%' . $filter . '%' )
            ->orwhere ( 'department', 'LIKE', '%' . $filter . '%' )
            ->orwhereHas('company', function ($query) use ($request) {
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

}
