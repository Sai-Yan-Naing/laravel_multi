<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function listCompany()
    {
        $companies = Company::paginate(10);
        return view('admin.company.index',compact('companies'));
    }

    public function eListCompany()
    {
        $companies = Company::paginate(10);
        return view('employee.company.index',compact('companies'));
    }

    public function createCompany()
    {
        return view('admin.company.create');
    }
    public function storeCompany(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255|unique:companies',
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
                'name'              => ['required',
                                    'string','max:255',
                                    Rule::unique('companies')->ignore($company->id,'id')
                                    ],
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
        $company->employees()->delete();
        $company->delete();
        return redirect()->route('listCompany');
    }
}
