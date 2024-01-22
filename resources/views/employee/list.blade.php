<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple LARAVE CRUD</title>
    <link rel="stylesheet" href="{{asset('bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.min.css')}}">
</head>
<body>

    <div class="bg-dark py-3">
        <div class="container">
            <div></div>
            <div class="h4 text-white">Simple LARAVE CRUD</div>
        </div>
    </div>

    <div class="container ">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Employee</div>
            <div>
                <a href="{{route('employee.create')}}" class="btn btn-primary">Create</a>
            </div>
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif

        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>image</th>
                        <th>name</th>
                        <th>email</th>
                        <th>address</th>
                        <th>action</th>
                    </tr>

                    @if($employee->isNotEmpty())

                    @foreach ($employee as $employee)
                    <tr valign="middle" >
                        <td>{{$employee->id}}</td>
                        <td>
                            @if($employee->image != '' && file_exists(public_path().'/uploads/employee/'.
                            $employee->image))
                              <img src="{{url('/uploads/employee/'.$employee->image)}}" alt="" width="40" 
                              height="40" class="rounded-circle">
                            @else
                            <img src="{{url('assets/uploads/employees/public/uploads/employee/public/uploads/employee/public/uploads/employee/no image.png'
                            .$employee->image)}}" alt="" width="40" 
                              height="40" class="rounded-circle">
                            @endif
                        </td>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->address}}</td>
                        <td>
                            <a href="{{route('employee.edit',$employee->id)}}" class="btn btn-primary btn-sm" >Edit</a>
                            <a href="#" onclick="deleteEmployee({{$employee->id}})"
                                 class="btn btn-danger btn-sm" >delete</a>

                            <form id="employee-edit-action-{{$employee->id}}" action="{{route('employee.destroy',
                            $employee->id)}}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    
                    @else
                        
                    <tr>
                        <td colspan="6" >Record Not Fount</td>
                    </tr>
                
                @endif

                </table>

            </div>
            
        </div>

    </div>
</body>
</html>

<script>
    function deleteEmployee(id) {
        if (confirm("sure for delete?")) {
            document.getElementById('employee-edit-action-'+id).submit();
        }
    }
</script>