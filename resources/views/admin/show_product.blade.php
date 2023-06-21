<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
      .fonts {
        color: black;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

            @if(session()->has('message'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              {{session()->get('message')}}
            </div>
            @endif
            
            <h1 class="pb-4 display-3 text-center">Products</h1>

            <table class="table table-secondary table-bordered fonts">
              <tr>
                <th>Product title</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Price</th>
                <th>Discount price</th>
                <th>Product image</th>
                <th style="text-align: center">Action</th>
              </tr>

              @foreach ($products as $product)
              <tr>
                    
                
                <td>{{$product->title}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->category_name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->discount_price}}</td>
                <td>
                  <img src="/product_img/{{$product->image}}" alt="">
                </td>
                <td>
                  <form action="{{url('/delete_product',$product->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('yakin ingin menghapus product')" class="btn btn-danger bg-danger">Delete</button>
                  </form>
                  <a href="{{url('update_product',$product->id)}}" class="btn btn-info">Edit</a>
                </td>
              
              </tr>
              @endforeach
            </table>

          </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.js')
  </body>
</html>