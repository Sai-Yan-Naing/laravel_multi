<?php

namespace App\Exports;

use App\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $filter;
    public function __construct($filter = "")
    {
        $this->filter = $filter;
    }
    public function view(): View
    {
        $filter = $this->filter;
        $employees = Employee::
        where ( 'staffid', 'LIKE', '%' . $filter . '%' )
        ->orwhere ( function($query) use ($filter) {
            $query->Where(DB::raw('CONCAT(first_name," ",last_name)'), 'LIKE', '%' . $filter . '%');
        } )
        ->orwhere ( 'last_name', 'LIKE', '%' . $filter . '%' )
        ->orwhere ( 'department', 'LIKE', '%' . $filter . '%' )
        ->orwhereHas('company', function ($query) use ($filter) {
            $query->where('name', 'like', "%{$filter}%");
        })

        ->get();
        return view('admin.dashboard.export', ['employees' => $employees,'filter'=>$filter]);
    }
}
