<!DOCTYPE html>
<html>
   <head>
    <base href="/public">
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
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         
      </div>  

      <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width:50%; padding: 30px;">
        <div class="box">
           <div class="img-box">
              <img src="product_img/{{$product->image}}" alt="">
           </div>
           <div class="detail-box">
              <h5>
               {{$product->title}}
              </h5>

              @if ($product->discount_price != 0)
                  <h6>
                     Disc %
                     Rp. {{$product->discount_price}}</h6>

                  <h6 style="text-decoration: line-through">
                     Rp. {{$product->price}}
                  </h6>
               @else
               <h6>
                  Rp. {{$product->price}}
               </h6>
              @endif 

              <h6>Product category : <b>{{$product->category_name}}</b></h6>
              <h6>Description : <b>{{$product->description}}</b></h6>
              <h6>Jumlah tersedia : <b>{{$product->quantity}}</b></h6>

              <a href="" class="btn btn-danger">Masukkan Keranjang</a>
              
           </div>
        </div>
     </div>

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
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