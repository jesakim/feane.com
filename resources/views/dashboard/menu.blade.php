@extends('dashboard/dashlayout')
@section('title','Menu')
@section('btnMenu',' active bg-gradient-primary')
@if (isset($loggedUser))

@section('name',$loggedUser['username'])
@endif
@section('content')
<div class="row">
    <div class="col-12 px-5 my-2 d-flex justify-content-end"><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button></div>
    {{-- errormsg --}}
    <div class="d-flex align-items-center justify-content-center" >
      <div class="bg-gradient-danger shadow-primary border-radius-lg mb-3 text-white text-capitalize ps-3" style="width: 80%">
         @error('name')
           <ul class="mt-3">
          <li>{{$message}}</li>
        </ul>
         @enderror
         @error('description')
           <ul class="mt-3">
          <li>{{$message}}</li>
        </ul>
         @enderror
         @error('price')
           <ul class="mt-3">
          <li>{{$message}}</li>
        </ul>
         @enderror
         @error('category')
           <ul class="mt-3">
          <li>{{$message}}</li>
        </ul>
         @enderror
         @error('image')
           <ul class="mt-3">
          <li>{{$message}}</li>
        </ul>
         @enderror


      </div>
    </div>

    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">menu ({{count($menu)}})</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">plats</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Prices</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Categories</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created_at</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @if (count($menu)>0)


                @foreach ($menu as $item)
                <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="{{asset('storage/images/'.$item['image']) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="{{$item['image']}}">
                        </div>
                        <div class="d-flex flex-column justify-content-center" style="width: 8rem;">
                          <h6 class="mb-0 text-sm text-wrap">{{$item['name']}}</h6>
                          <p class="text-sm text-secondary mb-0 text-wrap">{{$item['description']}}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="badge p-2 bg-gradient-primary">{{$item['price']}}$</p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-sm mb-0">{{$item['category']}}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{substr($item['created_at'],0,10)}}</span>
                    </td>
                    <td class="align-middle d-flex">
                      <button  class="btn btn-outline-info me-2" onclick="editplat({{$item}})" data-bs-toggle="modal" data-bs-target="#EditModal">
                        Edit
                      </button>
                    <form action="{{route('menu.destroy',$item['id'])}}" method="post">
                      @csrf
                      @method('DELETE')
                        <button class="btn btn-outline-danger" type="submit">
                          Delete
                        </button>
                    </form>

                    </td>
                </tr>
                @endforeach

                @else
                <tr>
                <td></td>
                <td></td>
                <td  class="align-middle">Add Plats to Display</td>
                <td></td>
                <td></td>
                </tr>

                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Add Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add To Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('menu.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
              <input type="file" class="form-control" id="inputGroupFile02" name="image">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Item Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Price</label>
                <input type="number" min="0" class="form-control"name="price">
            </div>
            <select class="form-control" name="category">
                <option >Select Category</option>
                <option value="Pizza">Pizza</option>
                <option value="Burger">Burger</option>
                <option value="Pasta">Pasta</option>
                <option value="Fries">Fries</option>
              </select>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" rows="3" name="description"></textarea>
              </div>
            </div>
            <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Add</button>
        </div>
      </form>


      </div>
    </div>
  </div>



    <!-- Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form method="POST" id="menuform">
              @csrf
              @method('PUT')
              <div class="input-group mb-3">
                <input type="file" class="form-control" id="inputGroupFile02" name="image">
              </div>
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Item Name</label>
                  <input type="text" class="form-control" id="nameinp" name="name">
              </div>
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Price</label>
                  <input type="number" min="0" class="form-control" id="priceinp" name="price">
              </div>
              <select class="form-control" name="category" id="categoryinp">
                <option >Select Category</option>
                <option value="Pizza">Pizza</option>
                <option value="Burger">Burger</option>
                <option value="Pasta">Pasta</option>
                <option value="Fries">Fries</option>
              </select>
              <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                  <textarea class="form-control" id="descriptioninp" rows="3" name="description"></textarea>
                </div>
              </div>
              <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Save</button>
          </div>
        </form>


        </div>
      </div>
    </div>
@endsection
