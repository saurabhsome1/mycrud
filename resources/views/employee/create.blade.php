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
                <a href="{{route('employee.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="{{route('employee.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <div class="mb-3">
                            <label for="name" class="form-label">NAME:</label>
                    <input type="text" name="name" id="name" placeholder="Enter name" class="form-control 
                    @error('name') is-invalid @enderror" value="{{old('name')}}" >
                    
                        
                    @error('name')
                    <p class="invalid-feedback" >{{$message}}</p>
                    @enderror
                </div>

                <div class="card-body">
                 <div class="mb-3">
                     <label for="email" class="form-label">E-mail:</label>
                   <input type="email" name="email" id="email" placeholder="Enter email" class="form-control
                   @error('email') is-invalid @enderror" value="{{old('email')}}" >

                   @error('email')
                   <p class="invalid-feedback" >{{$message}}</p>
                   @enderror

                </div>
                
            <div class="card-body">
            <div class="mb-3">
            <label for="address" class="form-label" >ADDRESS:</label>
     <textarea name="address" id="address" cols="30" rows="5" placeholder="Enter address" 
     class="form-control"> {{old('address')}}</textarea>
                            
          </div>

          <div class="mb-3">
            <label for="image" class="form-label" >Image:</label>
            <input type="file" name="image" class="@error('image') is-invalid @enderror">

            @error('image')
                   <p class="invalid-feedback" >{{$message}}</p>
                   @enderror

          </div>

            </div>
        </div>
        <button class="btn btn-primary mt-3">Save Employee</button>
      </form>
    </div>
    
</body>
</html>