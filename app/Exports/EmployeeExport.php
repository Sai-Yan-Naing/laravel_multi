<?php

namespace App\Exports;

use App\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
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
        ->orwhere ( 'first_name', 'LIKE', '%' . $filter . '%' )
        ->orwhere ( 'last_name', 'LIKE', '%' . $filter . '%' )
        ->orwhere ( 'department', 'LIKE', '%' . $filter . '%' )
        ->orwhereHas('company', function ($query) use ($filter) {
            $query->where('name', 'like', "%{$filter}%");
        })

        ->get();
        return view('admin.dashboard.export', ['employees' => $employees,'filter'=>$filter]);
    }
}
