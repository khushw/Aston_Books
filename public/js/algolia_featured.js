(function() {
    document.addEventListener('DOMContentLoaded', function () {
    var client = algoliasearch('WU7KCSIVS3', 'c95bb8dee14c91d38cdfb31b367ce7f9');
    var index = client.initIndex('products');
    var urlSync = true;
    var enterPressed = false;
    // var enterPressed = false;
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#aa-search-input',
        { hint: false }, {
            source: autocomplete.sources.hits(index, { hitsPerPage: 10 }),
            //value to be displayed in input control after user's suggestion selection
            displayKey: 'title',
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to render a single suggestion
                suggestion: function (suggestion) {
                    // due to styling issues (was display using flex we dont want that) custom defined variable 
                    // added the img src, /gallery/product thubnail, due to thumbnail stored in /gallery directory
                    const markup = ` 
                        <div class = "algolia-result">
                            <span>
                                
                                <img src="/gallery/${suggestion.thumbnail}" alt="img" class="algolia-thumb">
                                ${suggestion._highlightResult.title.value}
                            </span>
                            <span>£${suggestion._highlightResult.price.value}</span>
                        </div>
                        <div class = "algolia-description">
                            <span>${suggestion._highlightResult.description.value}</span>
                        </div>
                    `;
                    return markup;
                },
                // if there are no resutls display the below message
                empty: function(searchValue) {
                    return 'Sorry, there are no items relating to "' +  searchValue.query + '"';
                }
            }
            // when you select an item take it to that page
        }).on('autocomplete:selected' , function (event , suggestion , dataset){
            // window location origion grabs the url of the page you are currently on
            // suggestion variable holds the data the user selects
            window.location.href = window.location.origin + '/featured/' + suggestion.id + '/edit';
            enterPressed = true;
            // when the user presses enter and there is no product, redirect them to a dedicated search page
        }).on('keyup', function(event) {
            if (event.keyCode == 13 && !enterPressed) {
                window.location.href = window.location.origin + '/search';
            }
        });
    });
})();
