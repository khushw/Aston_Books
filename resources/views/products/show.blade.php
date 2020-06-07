
@extends('layouts.app')

@section ('content')

{{-- back button to go back on the all products --}}
<a href="/products"> < Products </a>


{{-- <a href='/products/{{ $product->id}}/edit' class='btn btn-default'> Edit Listing </a>

{{-- calling the destroy method 
in contrller and then remove the listing from the application --}}
{{-- {!!Form::open(['action'=> ['ProductController@destroy', $product->id], 'method' => 'POST' , 'class'=> 'pull-right'])!!} --}}
 {{-- //includes the hidden spoofing method and the submit button --}}
    {{-- {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
{!!Form::close() !!}  --}}

<hr>

<div class="container dark-grey-text mt-5">

    <!--Grid row-->
    <div class="row wow fadeIn">

      <!--Grid column for the image-->
      <div class="col-md-6 mb-4">    
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div id="box_show">
                    <img class="d-block w-100" src="/gallery/{{$product->thumbnail}}" alt="First slide">
                    </div>  
                  </div>
                <p hidden>{{$images = DB::table('photos')->where('product_id',$product->id)->get()}}
                    <p>
                        @foreach ( $images as $image)
                        <div class="carousel-item">
                            <div id="box_show">
                              <img class="d-block w-100" src="/gallery/{{$image->path}}" alt="First slide">                        
                            </div>  
                          </div>
                        @endforeach
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" id="cursor"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" id="cursor"></span>
                            <span class="sr-only">Next</span>
                        </a>
            </div>
        </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-md-6 mb-4">

        <!--Content-->
        <div class="p-4">

          <div class="mb-3"> 
            <a href="#">
              <span class="badge purple mr-1">{{ implode(' | ', $product->categories()->get()->pluck('name')->toArray()) }}</span>
            </a>
          </div>

          <p class="lead">
            <span>{{$currency}} {{$product->price}}</span>
          </p>

          <h1>{{$product->title}}</h1>

          <p class="lead">Description</p>

          <p>{{$product->description}}</p>

          <form action="{{route('carts.store')}}" method="POST" class="d-flex justify-content-left">
            {{ csrf_field() }}
            <!-- Default input -->
            <input type="number" value="{{$product->quantity}}" aria-label="Search" class="form-control" style="width: 100px" readonly>
            @can('list-edit-products')
            @if($product->quantity > 0)
                      <input type="hidden" name="id" value ="{{ $product->id}}">
                      <input type="hidden" name="title" value ="{{ $product->title}}">
                      <input type="hidden" name="price" value ="{{ $product->price}}">
                      <button class="btn btn-primary btn-md my-0 p" type="submit">Add to cart
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                      </button>
            @endif
          </form>
          @endcan
        </div>
        <!--Content-->
      </div>

      <!--Grid column-->
    </div>

    <!--Grid row-->
    <hr>
    <!--Grid row-->
    <div class="row d-flex justify-content-center wow fadeIn">
      <!--Grid column-->
      <div class="col-md-6 text-center">
        <h4 class="my-4 h4">Additional information</h4>
        <p>We value and appreciate your feedback, please click <a>here</a> if you want to leave a review/feedback!
        </p>
      </div>
      
      <!--Grid column-->
    </div>
    <!--Grid row-->

    <!--Grid row-->
    <div class="row wow fadeIn">

      <!--Grid column for product infomraiton-->
      <div class="col-lg-4 col-md-12 mb-4">

        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Product information
                </button>
              </h5>
            </div>
        
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                <ul id="product_info_1">
                  <li class="text-muted">
                    Condition: 
                    <label>{{$conditions}}</label>
                  </li>
                  <li class="text-muted">
                    Category: 
                    <label>{{ implode(' , ', $product->categories()->get()->pluck('name')->toArray()) }}</label>
                  </li>
                  <li class="text-muted">
                    Publisher: 
                    <label>{{$product->book_publisher}}</label>
                  </li>
                  <li class="text-muted">
                    Weight: 
                    <label>{{$product->weight}}{{$kilosymbol}}</label>
                  </li>
                </ul>
              </div>
            </div>

          </div>
        </div>

      </div>
      <!--Grid column-->

      <!--Grid column for product infomraiton-->
      <div class="col-lg-4 col-md-6 mb-4">

        <div id="accordion2">
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  Further Information
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion2">
              <div class="card-body">
                <ul id="product_info_1">
                  <li class="text-muted">
                    Pages:  
                    <label>{{$product->pages}}</label>
                  </li>
                  <li class="text-muted">
                    ISBN No: 
                    <label>{{$product->ISBN_NO}}</label>
                  </li>
                  <li class="text-muted">
                    Published Date:  
                    <label>{{$product->published_date}}</label>
                  </li>
                  <li class="text-muted">
                    Seller Name:  
                    <label><a href="/messages">{{$username}}</a></label>
                  </li>
                </ul>
              </div>
            </div>
          </div>

        </div>
        
      </div>
      <!--Grid column-->

      <!--Grid column for Reviews-->
      <div class="col-lg-4 col-md-6 mb-4">

        <div id="accordion3">          
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                  User Review's
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion3">
              <div class="card-body" id="review_styling">
                @foreach ($reviews as $review)
                  <hr> 
                  <a href='/messages'><strong>{{ DB::table('users')->where('id' , $review->user_id )->value('name')}}</strong></a>
                  <p><span class="text-muted">Description:</span>{{$review->body}}</p>
                  <p><span class="text-muted">Rating:</span><span class="badge badge-pill badge-success">{{$review->rating}}</span></p>
                  @if(Auth::id() == $review->user_id )
                      <form action="{{ route('review.delete', $review->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit"  title="Remove Item" class="btn btn-outline-danger btn-xs">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        <a href='{{route('review.edit' , $review->id)}}'><button type="button" class="btn btn-primary float-left" title="Edit Review"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                      </form>
                      
                  @endif
                  
                @endforeach  
              </div>
            </div>
          </div>
        </div>
      
      <!--Grid column for posting reviews-->  
        @can('list-edit-products')
        <div id="accordion4">          
          <div class="card">
            <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                  Post Review
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion4">
              <div class="card-body">
                <form action="{{route('review.store', $product->id)}}" method="POST"> <br>
                  @csrf
                  {{-- <label class="label" for="body">User Reviews</label><br> --}}
                  <div class="field">
                        <label class="label" for="body">Describe your experience</label>
                        <div class="control">
                            <input class="input" type="text" name="body" id="body" placeholder="write your experience here"> 
                        </div>
                  </div>
                  <div class="field">
                        <label class="label" for="rating">Pick a rating <span class="text-muted">5(Best)-1(Worst)</span></label>
                        <div class="control">
                                  <select class="input" type="number" name="rating">  
                                      @for ($i = 1; $i <= 5 ; $i++) 
                                          <option value="{{$i}}">{{$i}}</option>    
                                      @endfor 
                                  </select> 
                        </div>
                  </div>
                   <button type="submit" class="btn btn-primary"> Post </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        @endcan
      </div>
      <!--Grid column-->

    </div>
    <!--Grid row-->

</div>


@endsection