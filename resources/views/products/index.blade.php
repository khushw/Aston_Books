@extends('layouts.app')

@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection

@section ('content')

{{-- search bar auto complete algolia --}}
<div class="aa-input-container" id="aa-input-container">
    <input type="search" id="aa-search-input" class="aa-input-search" placeholder="Search with algolia..." name="search"
        autocomplete="off" />
    <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
        <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
    </svg>
</div>

{{-- end of search bar auto complete --}}

<h1>Products</h1>

{{-- to display the cateogries filter  --}}
<div class="products-section container">
    <div class="sidebar">
        <h3> By Category </h3>
        <ul>
            @foreach ($categories as $category)
                {{-- use query string to show the index page, for the category that is selected by the user --}}
                {{-- if cat the user on is the one he selected it will get highlighted, added css in the app.scss file for it aswell--}}
                <li class="{{ request()->category == $category->slug ? 'active' : ""}}"> <a href=" {{ route("products.index", ["category" => $category->name]) }}">{{$category->name}}</a><li>
            @endforeach
        </ul>
    </div>
    <div>
        {{-- displays the cateogry name the user has selected --}}
        <div class="products-header">
            <h1 class="stylish-heading"> {{$categoryName}} <h1>    
        </div>
        {{-- on every cateogry the user clicks on, they will have option to filter by price low to high and vice versa --}}
        <div>
            <strong>Filters</strong>
            {{-- as we are not in the a loop we have to get the cateogry by the request() --}}
            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "low_high"]) }}"> Low to High</a>
            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "high_low"]) }}"> High to Low</a>
            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "date_listed_earliest"]) }}"> Published Earliest</a>
            <a href="{{ route("products.index", ["category" => request()->category , "sort" => "date_listed_longest"]) }}"> Published Longest</a>
            
        </div>
    </div>
</div>
    {{-- use te forelse directive to handle if there are no products --}}
    @forelse ($products as $product)
  
    <div class="list-group-item">
        {{-- display the thumbnail --}}
        <img src="/gallery/{{$product->thumbnail}}">
        <h3><a href="/products/{{$product->id}}">{{$product->title}}</a></h3>
        <small> Price of the product {{$product->price}}</small>
    </div>
    @empty
        <div><h3> No items found </h3></div>
    @endforelse
        {{-- {{$products->links()}} --}}
        {{-- this appends the links if there is pre existing query string e.g. the price --}}
        {{ $products->appends(request()->input())->links() }}
@endsection

@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection