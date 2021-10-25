@extends('admin.header')
@section('content')
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Main Menu</div>
                    <a class="nav-link" href="{{ route('listCompany') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link" href="{{ route('listCompany') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Company
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
                <h1 class="mt-4 mb-4">Company Lists</h1>
                <div class="mb-4">
                    <a href="{{ route('createCompany') }}" class="btn btn-success text-white">Add New Company</a>
                </div>
                <table class="table table-bordered">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{$company->name}}</td>
                                <td>{{$company->email}}</td>
                                <td>{{$company->address}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ url('admin/'.$company->id.'/editCompany') }}" class="btn btn-warning mr-2">Edit</a>
                                        <form action="{{ route('destoryCompany',$company->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete company')" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                  </table>
            </div>
        </main>
    </div>
</div>
@endsection
