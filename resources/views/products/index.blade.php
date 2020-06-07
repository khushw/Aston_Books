@extends('layouts.app')

@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection

@section ('content')
{{-- search bar auto complete algolia --}}
<div class="aa-input-container" id="aa-input-container">
    <input type="search" id="aa-search-input" class="aa-input-search" placeholder="Search Aston Books..." name="search"
        autocomplete="off" />
    <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
        <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
    </svg>
</div>

{{-- end of search bar auto complete --}}
<h1 class="products_title"> Products</h1>
<div class="row">
    {{-- filters --}}
        <div class="col-md-2 align-self-top" style="margin-top:4.5%;">   
            {{-- filters side bar test --}}
            <aside class="col-md-8">
            <!-- COMPONENTS SIDEBAR -->
            <output style = "position:relative;" id="output_index">
            <div class="card" id="card_index">
                <article class="filter-group">
                    <header class="card-header">
                        <a href="#" data-toggle="collapse" data-target="#collapse_aside1" aria-expanded="false" class="collapsed">
                            <i class="icon-control fa fa-chevron-down"></i>
                            <h6 class="title_filters">Categories </h6>
                        </a>
                    </header>
                    <div class="filter-content collapse" id="collapse_aside1" style="">
                        <div class="card-body">
                            <ul class="list-menu">
                                @foreach ($categories as $category)
                                    <li class="{{ request()->category == $category->slug ? 'active' : ""}}"> <a href=" {{ route("products.index", ["category" => $category->name]) }}">{{$category->name}}</a><li>
                                @endforeach
                            </ul>
                        </div> <!-- card-body.// -->
                    </div>
                </article> <!-- filter-group  .// -->
                
                <article class="filter-group">
                    <header class="card-header">
                        <a href="#" data-toggle="collapse" data-target="#collapse_aside2" aria-expanded="false" class="collapsed">
                            <i class="icon-control fa fa-chevron-down"></i>
                            <h6 class="title_filters"> Price </h6>
                        </a>
                    </header>
                    <div class="filter-content collapse" id="collapse_aside2" style="">
                        <div class="card-body">
                            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "low_high"]) }}"> Low  - High</a><br>
                            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "high_low"]) }}"> High - Low</a>
                        </div> <!-- card-body.// -->
                    </div>
                </article> <!-- filter-group  .// -->

                <article class="filter-group">
                    <header class="card-header">
                        <a href="#" data-toggle="collapse" data-target="#collapse_aside3" aria-expanded="false" class="collapsed">
                            <i class="icon-control fa fa-chevron-down"></i>
                            <h6 class="title_filters"> Date Listed </h6>
                        </a>
                    </header>
                    <div class="filter-content collapse" id="collapse_aside3" style="">
                        <div class="card-body">
                            <i class='fas fa-pound-sign'></i>
                            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "date_listed_earliest"]) }}">  Oldest</a><br>
                            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "date_listed_longest"]) }}">   Latest</a>
                        </div> <!-- card-body.// -->
                    </div>
                </article> <!-- filter-group  .// -->

            </div> <!-- card.// -->
            </output>
            <!-- COMPONENTS SIDEBAR END .// -->
                </aside>
        </div>
    {{-- products --}}
    <div class="col-md-10" >
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    {{-- porducts display --}}
                    {{-- use te forelse directive to handle if there are no products --}}
                    @forelse ($products as $product)
    
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="/gallery/{{$product->thumbnail}}" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22208%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20208%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1714f6d2227%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A11pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1714f6d2227%22%3E%3Crect%20width%3D%22208%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2266.9453125%22%20y%3D%22117.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                        <h3 class="card-title">{{$product->title}} </h3>
                        <div class="card-body">
                            <p class="card-text">£{{$product->price}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                {{-- View the product page --}}
                                <a href="/products/{{$product->id}}"><button type="button" class="btn btn-sm btn-outline-secondary"> View</button></a>
                                {{-- add to cart button --}}
                                @if($product->quantity > 0)
                                {{-- button to add the product to the shopping cart with the bellow information  --}}
                                    <form action="{{route('carts.store')}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value ="{{ $product->id}}">
                                        <input type="hidden" name="title" value ="{{ $product->title}}">
                                        <input type="hidden" name="price" value ="{{ $product->price}}">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">Add to Cart </button>
                                    </form>
                                @endif
                            </div>
                            <small class="text-muted" title="Date Published">{{$product->published_date}}</small>
                            </div>
                        </div>
                        </div>
                    </div>
                    {{-- end the loop in here --}}
                    @empty
                    <div><h3> No items found </h3></div>
                     @endforelse
                </div>
            </div>
        </div>
    </div>
    
</div>
        {{-- PAGINATION --}}
        {{-- {{$products->links()}} --}}
        {{-- this appends the links if there is pre existing query string e.g. the price --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">                
                 {{ $products->appends(request()->input())->links() }}
                </div>
            </div>
        </div>

@endsection

@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection