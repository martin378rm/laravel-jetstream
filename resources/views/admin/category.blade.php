<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    
    <style>
      .div_center{
        text-align: center;
        padding-top: 40px;
      }
      .h2_font{
        font-size: 40px;
        padding-bottom: 40px;
      }
      .input_color{
        color: black;
      }
      .center {
        margin: auto;
        width: 50%;
        text-align: center;
        margin-top: 30px;
        border: 3px solid wheat;
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

            <div class="div_center">
              <h2 class="h2_font">Add Category</h2>

              <form action="{{url('/add_category')}}" method="POST">
                @csrf
                <input type="text" name="category" placeholder="write category name" class="input_color">
                <button class="btn btn-primary" name="submit" type="submit">+</button>
              </form>
            </div>

            <table class="center">
              <tr>
                <th>Category name</th>
                <th>Action</th>
              </tr>

              @foreach($datas as $data)
              <tr>
                <td>{{$data->category_name}}</td>
                <td>
                  <form action="{{url('delete_category',$data->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" onclick="return confirm('apakah yakin ingin menghapus data')" class="btn btn-warning">Delete</button>
                  </form>
                  
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