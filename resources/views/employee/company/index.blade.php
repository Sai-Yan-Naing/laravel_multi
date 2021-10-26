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
                <div class="small">Logged in as: {{Auth::user()->name}}</div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Company Lists</h1>
                <table class="table table-bordered">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                      </tr>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{$company->name}}</td>
                                <td>{{$company->email}}</td>
                                <td>{{$company->address}}</td>
                            </tr>
                        @endforeach
                  </table>
                  <div class="mt-8 float-right">
                    {{ $companies->links() }}
                  </div>
            </div>
        </main>
    </div>
</div>
@endsection
