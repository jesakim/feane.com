@extends('dashboard/dashlayout')
@section('title','Profile')
@section('btnProfile','active bg-gradient-primary')
@if(isset($loggedUser))
    
 @section('name',$loggedUser['username'])
@endif

@section('content')

<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1920&amp;q=80');">
      <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
      <div class="row gx-4 mb-2">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
            <img src="{{url('images/profilepic.webp')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
{{$loggedUser['username']}}            
</h5>
            <p class="mb-0 font-weight-normal text-sm">
              Admin
            </p>
          </div>
        </div>
      </div>
      <div class="d-flex align-items-center justify-content-center" >
        <div class="bg-gradient-danger shadow-primary border-radius-lg mb-3 text-white text-capitalize ps-3" style="width: 80%">
           @error('username')
             <ul class="mt-3">
            <li>{{$message}}</li>
          </ul>  
           @enderror
           @error('email')
             <ul class="mt-3">
            <li>{{$message}}</li>
          </ul>  
           @enderror 
           @error('current')
             <ul class="mt-3">
            <li>{{$message}}</li>
          </ul>  
           @enderror
           @error('newpass')
             <ul class="mt-3">
            <li>{{$message}}</li>
          </ul>  
           @enderror
           @if (Session::get('fail'))
           <ul class="mt-3">
            <li>{{Session::get('fail')}}</li>
           </ul>
             
         @endif
        
        </div>
      </div>
      <div class="d-flex align-items-center justify-content-center" >
        <div class="bg-gradient-success shadow-success border-radius-lg mb-3 text-white text-capitalize ps-3" style="width: 80%">
           
           @if (Session::get('success'))
           <ul class="mt-3">
            <li>{{Session::get('success')}}</li>
           </ul>
             
         @endif
        
        </div>
      </div>
      <div class="row">
        <div class="row">
          <div class="col-12 col-xl-4 mb-3">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0">Profile Infos</h6>
                  
                  <div class="text-end">
                    <a onclick="changepassword('infoform'); this.onclick=null;">
                      <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" aria-hidden="true" aria-label="Edit Password" data-bs-original-title="Edit Password"></i><span class="sr-only">Edit Profile</span>
                    </a>
                  </div>
                </div>
                </div>
              </div>
              <div class="card-body p-3">
                <form action="{{route('admin.edit')}}" method="post" id="infoform">
                  <div>

                    @csrf
                  </div>
                    <div class="form-floating mb-3">    
                        <input type="text" class="form-control validate ps-3" id="floatingInputInvalid" placeholder=" " value="{{$loggedUser['username']}}" disabled name="username">
                        <label for="floatingInputInvalid ps-2">Username</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control validate ps-3" id="floatingInputInvalid" placeholder=" " value="{{$loggedUser['email']}}" disabled name="email">
                        <label for="floatingInputInvalid ps-2">Email</label>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-4 mb-3">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0">Password</h6>
                  
                  <div class="col-md-4 text-end">
                    <a onclick="changepassword('passform'); this.onclick=null;">
                      <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" aria-hidden="true" aria-label="Edit Password" data-bs-original-title="Edit Password"></i><span class="sr-only">Edit Profile</span>
                    </a>
                  </div>
                </div>
                </div>
              </div>
              <div class="card-body p-3">
                <form action="{{route('admin.editpass')}}" method="post" id="passform">
                  <div>
                    @csrf
                  </div>
                    <div class="form-floating mb-3">    
                        <input type="text" class="form-control validate ps-3" id="floatingInputInvalid" disabled placeholder=" " name="current">
                        <label for="floatingInputInvalid ps-2">Current Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control validate ps-3" id="floatingInputInvalid" disabled placeholder=" " name="newpass">
                        <label for="floatingInputInvalid ps-2">New Password</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control validate ps-3" id="floatingInputInvalid" disabled placeholder=" " name="newpass_confirmation">
                        <label for="floatingInputInvalid ps-2">Confirm Password</label>
                    </div>
                    
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection