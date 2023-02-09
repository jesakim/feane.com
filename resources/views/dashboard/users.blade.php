@extends('dashboard/dashlayout')
@section('title','Table')
@section('btnTables','active bg-gradient-primary')
@if(isset($loggedUser))
    
 @section('name',$loggedUser['username'])
@endif

@section('content')

<div class="row">
    <div class="col-12 px-5 my-2 d-flex justify-content-end"><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button></div>
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Reservations</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Client</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">N° Persons</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N° Phone</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Res. Date</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                    
                
                <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="{{url('images/table_res.jpg')}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user6">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Miriam Eric</h6>
                          <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="font-weight-bold mb-0">20 $</p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="badge p-2 bg-gradient-primary">06 34 34 34 34</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">14/09/20</span>
                    </td>
                    <td class="align-middle">
                      <a href="javascript:;" class="text-danger font-weight-bold text-decoration-none" data-toggle="tooltip" data-original-title="Edit user">
                        Cancel
                      </a>
                    </td>
                </tr> 
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection