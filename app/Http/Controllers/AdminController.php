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
        // $employees = Employee::
        // where ( 'first_name', 'LIKE', '%' . $filter . '%' )
        // ->orwhere ( 'last_name', 'LIKE', '%' . $filter . '%' )
        // ->orwhere ( 'department', 'LIKE', '%' . $filter . '%' )
        // ->orwhereHas('company', function ($query) use ($request) {
        //     $query->where('name', 'like', "%{$request->filter}%");
        // })
        // ->paginate(2);
        $employees = Employee::paginate(2);
        return view('admin.dashboard.index',compact('employees','filter'));
    }

    public function listCompany()
    {
        $companies = Company::paginate(1);
        return view('admin.company.index',compact('companies'));
    }
    public function createCompany()
    {
        return view('admin.company.create');
    }
    public function storeCompany(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:companies',
            'address'            => 'required|string',
        ]);

        $company = Company::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'address'   => $request->address,
        ]);
        return redirect()->route('listCompany');
    }

    public function editCompany($id)
    {
        $company = Company::find($id);
        return view('admin.company.edit',compact('company'));
    }

    public function updateCompany(Request $request,$id)
    {
        $company = Company::findOrFail($id);
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => ['required',
                                    'string','email','max:255',
                                    Rule::unique('companies')->ignore($company->id,'id')
                                ],
            'address'            => 'required|string',
        ]);

        $company->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'address'   => $request->address,
        ]);
        return redirect()->route('listCompany');
    }
    public function deleteCompany($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('listCompany');
    }

    public function export($filter='')
    {
        // return $filter;
        return Excel::download(new EmployeeExport($filter), 'employee.csv');
    }

}
