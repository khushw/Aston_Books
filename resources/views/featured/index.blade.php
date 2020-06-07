@extends('layouts.app')

@section('extra-css')
    <link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection

@section('content')

@section ('content')
{{-- search bar auto complete algolia --}}
<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-6">
            <div class="aa-input-container" id="aa-input-container">
                <input type="search" id="aa-search-input" class="aa-input-search" placeholder="Search Aston Books..." name="search"
                    autocomplete="off" />
                <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                    <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    {{-- this table came from https://getbootstrap.com/docs/4.3/content/tables/ --}}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Product Title</th>
                            <th scope="col">Featured</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                <th scope="row">{{$product->id}}</th>
                                    
                                    <td>{{$product->title}}</td> 
                                    <td>
                                        @if($product->featured == 0)
                                        <p> False </p>
                                        @elseif($product->featured == 1)
                                        <p> True </p>
                                        @endif
                                    </td> 
                                    <td>
                                        @can('edit-users')
                                        <a href="/featured/{{ $product->id}}/edit"><button type="button" class="btn btn-primary float-left">Edit</button></a>  
                                        @endcan
                                    </td>
                                </tr>  
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia_featured.js') }}"></script>
@endsection