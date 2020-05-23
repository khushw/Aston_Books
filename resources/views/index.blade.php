@extends('layouts.app')
@section('extra-css')
<link href="https://getbootstrap.com/docs/4.0/examples/carousel/carousel.css" rel="stylesheet">
@endsection
@section('index')     
                <main role="main" id="home_page_main">

                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class=""></li>
                            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                            <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
                          </ol>
                          <div class="carousel-inner">
                            <div class="carousel-item">
                              <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
                              <div class="container">
                                <div class="styling_first">
                                  <h1 id="styling_first_h1">Welcome to Aston Books!</h1>
                                  <p id="styling_first_p">We are a start up, e-commerce retailer that specialises in Books. We are here to look after our customers and grow!</p>
                                  <p><a class="btn btn-lg btn-primary" href="login" role="button">Log In</a></p>
                                </div>
                              </div>
                            </div>
                            <div class="carousel-item">
                              <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
                              <div class="container">
                                <div class="styling_second">
                                  <h1 id="styling_first_h1">Register if you haven't already!</h1>
                                  <p id="styling_first_p">Experience selling and buying books within minutes. Get ability to chat to your customers and sellers via our live chat option! Experince 0% commision transactions</p>
                                  <p><a class="btn btn-lg btn-primary" href="register" role="button">Sign Up Today</a></p>
                                </div>
                              </div>
                            </div>
                            <div class="carousel-item active">
                              <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
                              <div class="container">
                                <div class="styling_third">
                                  <h1 id="styling_first_h1">View our deals</h1>
                                  <p id="styling_first_p">Visit our link below to view deals listed by our customers. Be sure to provide feedback, as we love to improve user experience!</p>
                                  <p><a class="btn btn-lg btn-primary" href="/products" role="button">Shop</a></p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev" id="next_cursor">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next" id="next_cursor">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                        
                        <!-- Marketing messaging and featurettes
                        ================================================== -->
                        <!-- Wrap the rest of the page in another container to center all the content. -->
                  
                        <div class="container marketing">
                                <p id="featured_text">Featured Products</p>
                                <hr>
                                <br>
                                <br>
                  
                          <!-- Three columns of text below the carousel -->
                          <div class="row">
                                @forelse ($products as $product)      
                                <div class="col-lg-4">
                                        <img class="w3-round" src="/gallery/{{$product->thumbnail}}" alt="Generic placeholder image" width="200" height="200">
                                        <h2>{{$product->title}}</h2>
                                        <p>{{$product->description}}</p>
                                        <p><a class="btn btn-secondary" href="/products/{{$product->id}}" role="button">View details »</a></p>
                                </div><!-- /.col-lg-4 -->
                                @empty
                                <div><h3> No items found </h3></div>
                                @endforelse
                            {{-- <div class="col-lg-4">
                              <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                              <h2>Heading</h2>
                              <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
                              <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
                            </div><!-- /.col-lg-4 -->
                            <div class="col-lg-4">
                              <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                              <h2>Heading</h2>
                              <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                              <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
                            </div><!-- /.col-lg-4 --> --}}
                          </div><!-- /.row -->
                  
                  
                          <!-- START THE FEATURETTES -->
                  
                          <hr class="featurette-divider">
                  
                          <div class="row featurette">
                            <div class="col-md-7">
                              <h2 class="featurette-heading">Live Chat. <span class="text-muted">Chat with traders and suppliers</span></h2>
                              <p class="lead">Use our live chat feature, to get real time feedback and updates from your end users. Contact our staff via the chat option to provide feedback!</p>
                            </div>
                            <div class="col-md-5">
                              <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500" style="width: 500px; height: 500px;" src="/gallery/live_chat.png" data-holder-rendered="true">
                            </div>
                          </div>
                  
                          <hr class="featurette-divider">
                  
                          <div class="row featurette">
                            <div class="col-md-7 order-md-2">
                              <h2 class="featurette-heading">Zero percent commision <span class="text-muted">It'll blow your mind.</span></h2>
                              <p class="lead">There are no hidden charges, list an item for free and wait to ship!</p>
                            </div>
                            <div class="col-md-5 order-md-1">
                              <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500" src="/gallery/store-0-percent.png" data-holder-rendered="true" style="width: 500px; height: 500px;">
                            </div>
                          </div>
                  
                          {{-- <hr class="featurette-divider"> --}}
                  
                          <!-- /END THE FEATURETTES -->
                  
                        </div><!-- /.container -->
                  
                  

                </main>
@endsection

{{-- 0 commision --}}
{{-- https://www.google.com/search?q=0%25+commission&sxsrf=ALeKk03aCVT2ylWefBF9jj1gyb5ocYe90g:1590176606879&source=lnms&tbm=isch&sa=X&ved=2ahUKEwjPxKG-ncjpAhUz7HMBHXzIDz4Q_AUoAXoECA0QAw&biw=1164&bih=587#imgrc=FeE0OMkLuuNTMM --}}
{{-- live chat link --}}
{{-- https://www.google.com/search?q=live+chat&tbm=isch&chips=q:live+chat,g_1:icon:ACrpsh6pQ04%3D&hl=en&ved=2ahUKEwjCzP2knsjpAhXcFrcAHdtcD5YQ4lYoAXoECAEQFg&biw=1148&bih=587#imgrc=W6VQumC39Y-fJM --}}