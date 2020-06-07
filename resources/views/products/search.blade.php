@extends('layouts.app')

@section('content')
  
    <ais-index
    app-id="WU7KCSIVS3"
    api-key="c95bb8dee14c91d38cdfb31b367ce7f9"
    index-name="products"
    >

    <div class="container">
    <div class="search-results-container-algolia">
        {{-- search box --}}
        <div class="search-box">
            <h2>Search</h2>
            <ais-search-box></ais-search-box>
            {{-- display the number of results --}}
            <ais-stats></ais-stats>
        </div>
        
        {{-- display the categories  --}}
        <div class="refinement-list">
            <h2>Categories</h2>
            <ais-refinement-list attribute-name="categories" :sort-by="['name:asc']"></ais-refinement-list>
            <hr>
            <h2> Conditions</h2>
            <ais-refinement-list attribute-name="condition_id"></ais-refinement-list>
        </div>
        <hr>
        
        <ais-results>
            <template slot-scope="{ result }">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                                <img :src="`/gallery/${result.thumbnail}`" alt="img" class="img_instant_search">
                        </div>
                        <div class="col-md-6">
                            <a :href="`/products/${result.id}`">
                                <div class="instantsearch-result">
                                    <div>
                                        <div class="result-title">
                                            <ais-highlight :result="result" attribute-name="title"></ais-highlight>
                                        </div>
                                        <div class="result-description">
                                            <ais-highlight :result="result" attribute-name="description"></ais-highlight>
                                        </div>
                                        <div class="result-price">
                                            <ais-highlight :result="result" attribute-name="price"></ais-highlight>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <hr>
                        </div>
                    </div>
                </div>
                <div>
    
                </div> 
            </template>
        </ais-results>
            <div class="pagination_search">
                <ais-pagination></ais-pagination>
            </div>
        </div>
    </div>
            
    </ais-index>  
@endsection