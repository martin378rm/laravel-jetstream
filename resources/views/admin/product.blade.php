<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
      .div_center {
        text-align: center;
        padding-top: 40px;
      }
      .font_size {
        font-size: 40px;
        padding-bottom: 40px;
      }
      .text_color {
        color: black;
      }
      label {
        display: inline-block;
        width:  200px;
      }
      .div_design {
        padding-bottom: 15px;
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
              <h1 class="font_size">Add product</h1>

              <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="div_design">
                  <label for="title">Product title</label>
                  <input required type="text" name="title" id="title" class="text_color">
                </div>
                <div class="div_design">
                  <label for="description">Product description</label>
                  <input type="text" required name="description" id="description" class="text_color">
                </div>
                <div class="div_design">
                  <label for="price">Product price</label>
                  <input type="number" min="0" name="price" id="price" class="text_color">
                </div>
                <div class="div_design">
                  <label for="discount_price">Discount price</label>
                  <input type="number" required name="discount_price" id="discount_price" class="text_color">
                </div>
                <div class="div_design">
                  <label for="quantity">Product quantity</label>
                  <input type="number" required min="0" name="quantity" id="quantity" class="text_color">
                </div>
                <div class="div_design">
                  <label for="category_id">Category ID</label>
                  <select name="category_id" id="category_id" class="text_color">
                    <option value="">pilih....</option>
                    @foreach ($category as $item)
                    <option value="{{$item->id}}" required>{{$item->id}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="div_design">
                  <label for="image">Product title</label>
                  <input type="file" required name="image" id="image" class="text_color bg-primary">
                </div>
                <div class="div_design">
                  <button type="submit" class="btn btn-primary">save</button>
                </div>
              </form>
                 
            </div>

            

          </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.js')
  </body>
</html>