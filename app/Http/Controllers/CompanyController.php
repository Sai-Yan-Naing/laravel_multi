<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'min:8'],
        ]);
    }
    public function index()
    {
        return view('company.index');
    }
    public function create()
    {
        return view('company.create');
    }
    public function store(Request $request)
    {

    }

    public function edit($id)
    {
        return view('company.edit');
    }

    public function update($id)
    {

    }
}
