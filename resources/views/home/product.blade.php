<section class="product_section layout_padding">
  <div class="container">
     <div class="heading_container heading_center">
        <h2>
           Our <span>products</span>
           {{-- add to cart --}}
           
        </h2>
     </div>

     @if(session()->has('message'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
              </div>
           @endif

     <div class="row">

     

         @foreach ($products as $product)
         
         
        <div class="col-sm-6 col-md-4 col-lg-4">
           <div class="box">
              <div class="option_container">
                 <div class="options">
                    <a href="{{url('product_details', $product->id)}}" class="option1">
                     Product Detail
                    </a>
                    <form action="{{url('add_cart', $product->id)}}" method="POST">
                     @csrf

                     <div class="row">
                        <div class="col-md-4">
                           <input type="number" min="1" name="quantity" value="1" style="width: 80px">
                        </div>
                        <div class="col-md-4">
                           <input type="submit" value="Keranjang ">
                        </div>
                     </div>

                    </form>
                 </div>
              </div>
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

                 
              </div>
           </div>
        </div>
        @endforeach
        
        {{-- {!!$product->appends(Request->all())->links()!!} --}}
        
      </div>
      {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
     <div class="btn-box">
        <a href="">
        View All products
        </a>
     </div>
  </div>
</section>