@extends('layouts.app')

@section('content')
  
    <ais-index
    app-id="WU7KCSIVS3"
    api-key="c95bb8dee14c91d38cdfb31b367ce7f9"
    index-name="products"
    >
    <ais-search-box></ais-search-box>
    {{-- display the number of results --}}
    <ais-stats></ais-stats>
        {{-- display the categories  --}}
        <div>
            <h2>Categories</h2>
         <ais-refinement-list attribute-name="categories" :sort-by="['name:asc']"></ais-refinement-list>
        </div>

    {{-- for conditions --}}
    <div>
        <h2> Conditions</h2>
    <ais-refinement-list attribute-name="condition_id"></ais-refinement-list>
    </div>
    
    
    <ais-results>
        <template slot-scope="{ result }">
            {{-- <h2>
            <ais-highlight :result="result" attribute-name="id"></ais-highlight>
            </h2> --}}
            
            <div>
                {{-- link to the item page --}}
                <a :href="`/products/${result.id}`">
                    <div class="instantsearch-result">
                        {{-- <div>
                            <img :src="">
                        </div> --}}
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
        </template>
    </ais-results>
        <ais-pagination></ais-pagination>
    </ais-index>  
@endsection