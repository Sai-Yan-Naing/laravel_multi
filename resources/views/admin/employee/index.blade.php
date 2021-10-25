@extends('admin.header')
@section('content')
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Main Menu</div>
                    <a class="nav-link" href="{{ route('listEmployee') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link" href="{{ route('listEmployee') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Employee
                    </a>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Employee
                    </a>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Department
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4 mb-4">Employee Lists</h1>
                <div class="mb-4">
                    <a href="{{ route('createEmployee') }}" class="btn btn-success text-white">Add New Employee</a>
                </div>
                <table class="table table-bordered">
                      <tr>
                        <th>StaffID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Department</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{$employee->staffid}}</td>
                                <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->company_id}}</td>
                                <td>{{$employee->department}}</td>
                                <td>{{$employee->address}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('editEmployee',$employee->id) }}" class="btn btn-warning mr-2 text-white">Edit</a>
                                        <form action="{{ route('destoryEmployee',$employee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete Employee')" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
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
