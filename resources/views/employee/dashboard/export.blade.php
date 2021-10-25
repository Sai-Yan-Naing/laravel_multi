<table class="table table-bordered">
    <tr>
      <th>StaffID {{$filter}}</th>
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
