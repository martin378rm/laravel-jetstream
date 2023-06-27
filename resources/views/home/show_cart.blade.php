<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Laravel - </title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

      <style>
        .center {
          margin: auto;
          width: 50%;
        }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
        
         @if(session()->has('message'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{session()->get('message')}}
          </div>
        @endif


      <div class="center">
        <table class="table table-striped table-bordered">
          <tr class="table-info">
            <th>Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Image</th>
            <th>Action</th>
          </tr>

          @php
              $total = 0;
          @endphp
          @foreach ($cart as $item)
              
          <tr>
            <td>{{$item->product_title}}</td>
            <td>{{$item->quantity}}</td>
            <td>{{$item->quantity * $item->price}}</td>
            <td><img src="product_img/{{$item->image}}" width="150" height="150" alt=""></td>
            <td>
              <form action="{{url('remove_cart', $item->id)}}" method="POST">
              
                @csrf
                @method('delete')
                <button class="btn btn-danger" type="submit">delete</button>

              </form>
            </td>
          </tr>
          
          

            @php
            $total += ($item->quantity * $item->price)
            @endphp
          @endforeach
        </table>
      </div>
      
      <h3 class="center">Total pembayaran :&nbsp; {{$total}}</h3>

      <div class="center">
        <h2>Proceed To Order</h2>
        <a href="{{url('cash_order')}}" class="btn btn-danger">Cash on Delivery</a>
        <a href="{{url('stripe', $total)}}" class="btn btn-danger">Pay Using Card</a>
      </div>
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      </div>
      <!-- jQery -->
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>
   </body>
</html>