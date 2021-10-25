@extends('employee.header')
@section('content')
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Main Menu</div>
                    <a class="nav-link" href="{{ route('employeeDashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link" href="{{ route('eListCompany') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Company
                    </a>
                    <a class="nav-link" href="{{ route('eListEmployee') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Employee
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as: {{Auth::user()->full_name()}}</div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h2 class="mt-4 mb-4">Employee Dashboard</h2>

                <!-- Navbar Search-->
                <div class="d-flex mb-2">
                    <div></div>
                    <form action="{{ route('employeeDashboard') }}" method="get" class="ml-auto">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" name="filter" value="{{$filter}}" />
                            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <!-- Navbar-->
                <table class="table table-bordered">
                      <tr>
                        <th>StaffID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th>Address</th>
                      </tr>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{$employee->staffid}}</td>
                                <td>{{$employee->full_name()}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->company->name}}</td>
                                <td>{{$employee->department}}</td>
                                <td>{{$employee->phone}}</td>
                                <td>{{$employee->address}}</td>
                            </tr>
                        @endforeach
                  </table>
                  <div class="mt-8 float-right">
                    {{ $employees->links() }}
                  </div>
            </div>
        </main>
    </div>
</div>
@endsection
