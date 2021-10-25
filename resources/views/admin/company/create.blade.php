@extends('admin.header')
@section('content')
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Main Menu</div>
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link" href="{{ route('listCompany') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Company
                    </a>
                    <a class="nav-link" href="{{ route('listEmployee') }}">
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
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h2 class="mt-4 mb-4">New Company</h2>
                        <form action="{{ route('storeCompany') }}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="mb-2" for="name">Name:</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Company name" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-2" for="email">Email:</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-2" for="address">Address:</label>
                                <textarea type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Enter address" name="address" autocomplete="address" autofocus>{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
