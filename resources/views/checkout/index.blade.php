@extends('layouts.app')

@section ('content')
        <div class="container" style="padding-top: 1%;">
            <div class="row">
              {{-- Display cart details --}}
                <div class="col-md-4 order-md-2 mb-4">
                  <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">{{ Cart::count()}}</span>
                  </h4>
                  <ul class="list-group mb-3">
                    @foreach (Cart::content() as $item)
                      <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                          <h6 class="my-0">{{$item->model->title}}</h6>
                          <small class="text-muted">Quantity:{{$item->qty}}</small>
                        </div>
                        <span class="text-muted">£{{$item->model->price}}</span>
                      </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                      <span>Total (GBP)</span>
                      <strong>£{{Cart::total()}}</strong>
                    </li>
                  </ul>

                </div>
              {{-- end of cart details --}}

              {{-- display the checkout form --}}
                <div class="col-md-8 order-md-1">
                  <h4 class="mb-3">Billing Details</h4>
                  <form action="{{route('checkout.store')}}" method="POST" id="payment-form">
                    {{ csrf_field() }}

                    <div class="row">
                      <div class="col-md-6 mb-3">
                      <label for="name">Full name <span class="text-muted">(Editable)</span></label>
                      <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{$name}}">
                      </div>
                    </div>
 
                    <div class="mb-3">
                      <label for="email">Email <span class="text-muted">(Editable)</span></label>
                      <input type="email" class="form-control" id="email" placeholder="you@aston.ac.uk" name="email" value="{{$email}}">
                    </div>
                    
                    <div class="mb-3">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address" placeholder="1234 Elm Road" name="address" value="{{ old ('address') }}">
                    </div>

                    <div class="row">
                      <div class="col-md-5 mb-3">
                        <label for="city">City</label>
                        <select class="custom-select d-block w-100" id="city" name="city" value="{{ old ('city') }}">
                          <option value="">Choose...</option>
                          <option value='Abingdon'>Abingdon</option>
                          <option value='Accrington'>Accrington</option>
                          <option value='Acle'>Acle</option>
                          <option value='Acton'>Acton</option>
                          <option value='Adlington'>Adlington</option>
                          <option value='Alcester'>Alcester</option>
                          <option value='Aldeburgh'>Aldeburgh</option>
                          <option value='Aldershot'>Aldershot</option>
                          <option value='Alford'>Alford</option>
                          <option value='Alfreton'>Alfreton</option>
                          <option value='Alnwick'>Alnwick</option>
                          <option value='Alsager'>Alsager</option>
                          <option value='Alston'>Alston</option>
                          <option value='Alton'>Alton</option>
                          <option value='Altrincham'>Altrincham</option>
                          <option value='Amble'>Amble</option>
                          <option value='Ambleside'>Ambleside</option>
                          <option value='Amersham'>Amersham</option>
                          <option value='Amesbury'>Amesbury</option>
                          <option value='Ampthill'>Ampthill</option>
                          <option value='Andover'>Andover</option>
                          <option value='Appleby-in-Westmorland'>Appleby-in-Westmorland</option>
                          <option value='Arlesey'>Arlesey</option>
                          <option value='Arundel'>Arundel</option>
                          <option value='Ashbourne'>Ashbourne</option>
                          <option value='Ashburton'>Ashburton</option>
                          <option value='Ashby Woulds'>Ashby Woulds</option>
                          <option value='Ashby-de-la-Zouch'>Ashby-de-la-Zouch</option>
                          <option value='Ashford'>Ashford</option>
                          <option value='Ashington'>Ashington</option>
                          <option value='Ashton-under-Lyne'>Ashton-under-Lyne</option>
                          <option value='Askern'>Askern</option>
                          <option value='Aspatria'>Aspatria</option>
                          <option value='Atherstone'>Atherstone</option>
                          <option value='Attleborough'>Attleborough</option>
                          <option value='Axbridge'>Axbridge</option>
                          <option value='Axminster'>Axminster</option>
                          <option value='Aylesbury'>Aylesbury</option>
                          <option value='Aylsham'>Aylsham</option>
                          <option value='Bacup'>Bacup</option>
                          <option value='Bakewell'>Bakewell</option>
                          <option value='Banbury'>Banbury</option>
                          <option value='Barking'>Barking</option>
                          <option value='Barnard Castle'>Barnard Castle</option>
                          <option value='Barnes'>Barnes</option>
                          <option value='Barnet'>Barnet</option>
                          <option value='Barnoldswick'>Barnoldswick</option>
                          <option value='Barnsley'>Barnsley</option>
                          <option value='Barnstaple'>Barnstaple</option>
                          <option value='Barrow-in-Furness'>Barrow-in-Furness</option>
                          <option value='Barton-upon-Humber'>Barton-upon-Humber</option>
                          <option value='Basildon'>Basildon</option>
                          <option value='Basingstoke'>Basingstoke</option>
                          <option value='Batley'>Batley</option>
                          <option value='Battle'>Battle</option>
                          <option value='Bawtry'>Bawtry</option>
                          <option value='Beaconsfield'>Beaconsfield</option>
                          <option value='Beaminster'>Beaminster</option>
                          <option value='Bebington'>Bebington</option>
                          <option value='Beccles'>Beccles</option>
                          <option value='Beckenham'>Beckenham</option>
                          <option value='Bedale'>Bedale</option>
                          <option value='Bedford'>Bedford</option>
                          <option value='Bedworth'>Bedworth</option>
                          <option value='Belper'>Belper</option>
                          <option value='Bentham'>Bentham</option>
                          <option value='Berkeley'>Berkeley</option>
                          <option value='Berkhamsted'>Berkhamsted</option>
                          <option value='Berwick-upon-Tweed'>Berwick-upon-Tweed</option>
                          <option value='Beverley'>Beverley</option>
                          <option value='Bewdley'>Bewdley</option>
                          <option value='Bexhill-on-Sea'>Bexhill-on-Sea</option>
                          <option value='Bexley'>Bexley</option>
                          <option value='Bicester'>Bicester</option>
                          <option value='Biddulph'>Biddulph</option>
                          <option value='Bideford'>Bideford</option>
                          <option value='Biggleswade'>Biggleswade</option>
                          <option value='Billericay'>Billericay</option>
                          <option value='Billingham'>Billingham</option>
                          <option value='Bilston'>Bilston</option>
                          <option value='Bingham'>Bingham</option>
                          <option value='Bingley'>Bingley</option>
                          <option value='Birchwood'>Birchwood</option>
                          <option value='Birkenhead'>Birkenhead</option>
                          <option value='Bishop Auckland'>Bishop Auckland</option>
                          <option value='Bishop's Castle'>Bishop's Castle</option>
                          <option value='Bishop's Stortford'>Bishop's Stortford</option>
                          <option value='Bishop's Waltham'>Bishop's Waltham</option>
                          <option value='Blackburn'>Blackburn</option>
                          <option value='Blackpool'>Blackpool</option>
                          <option value='Blackrod'>Blackrod</option>
                          <option value='Blackwater and Hawley'>Blackwater and Hawley</option>
                          <option value='Blandford Forum'>Blandford Forum</option>
                          <option value='Bletchley and Fenny Stratford'>Bletchley and Fenny Stratford</option>
                          <option value='Blyth'>Blyth</option>
                          <option value='Bodmin'>Bodmin</option>
                          <option value='Bognor Regis'>Bognor Regis</option>
                          <option value='Bollington'>Bollington</option>
                          <option value='Bolsover'>Bolsover</option>
                          <option value='Bolton'>Bolton</option>
                          <option value='Bootle'>Bootle</option>
                          <option value='Boroughbridge'>Boroughbridge</option>
                          <option value='Boston'>Boston</option>
                          <option value='Bottesford'>Bottesford</option>
                          <option value='Bourne'>Bourne</option>
                          <option value='Bournemouth'>Bournemouth</option>
                          <option value='Bovey Tracey'>Bovey Tracey</option>
                          <option value='Brackley'>Brackley</option>
                          <option value='Bracknell'>Bracknell</option>
                          <option value='Bradford-on-Avon'>Bradford-on-Avon</option>
                          <option value='Brading'>Brading</option>
                          <option value='Bradley Stoke'>Bradley Stoke</option>
                          <option value='Bradninch'>Bradninch</option>
                          <option value='Braintree'>Braintree</option>
                          <option value='Brampton'>Brampton</option>
                          <option value='Brandon'>Brandon</option>
                          <option value='Braunstone Town'>Braunstone Town</option>
                          <option value='Brentford'>Brentford</option>
                          <option value='Brentwood'>Brentwood</option>
                          <option value='Bridgnorth'>Bridgnorth</option>
                          <option value='Bridgwater'>Bridgwater</option>
                          <option value='Bridlington'>Bridlington</option>
                          <option value='Bridport'>Bridport</option>
                          <option value='Brierfield'>Brierfield</option>
                          <option value='Brierley'>Brierley</option>
                          <option value='Brigg'>Brigg</option>
                          <option value='Brighouse'>Brighouse</option>
                          <option value='Brightlingsea'>Brightlingsea</option>
                          <option value='Brixham'>Brixham</option>
                          <option value='Broadstairs and St Peter's'>Broadstairs and St Peter's</option>
                          <option value='Bromborough'>Bromborough</option>
                          <option value='Bromley'>Bromley</option>
                          <option value='Bromsgrove'>Bromsgrove</option>
                          <option value='Bromyard and Winslow'>Bromyard and Winslow</option>
                          <option value='Broseley'>Broseley</option>
                          <option value='Broughton'>Broughton</option>
                          <option value='Broughton-in-Furness'>Broughton-in-Furness</option>
                          <option value='Bruton'>Bruton</option>
                          <option value='Buckfastleigh'>Buckfastleigh</option>
                          <option value='Buckingham'>Buckingham</option>
                          <option value='Bude-Stratton'>Bude-Stratton</option>
                          <option value='Budleigh Salterton'>Budleigh Salterton</option>
                          <option value='Bulwell'>Bulwell</option>
                          <option value='Bungay'>Bungay</option>
                          <option value='Buntingford'>Buntingford</option>
                          <option value='Burford'>Burford</option>
                          <option value='Burgess Hill'>Burgess Hill</option>
                          <option value='Burgh-le-Marsh'>Burgh-le-Marsh</option>
                          <option value='Burnham-on-Crouch'>Burnham-on-Crouch</option>
                          <option value='Burnham-on-Sea and Highbridge'>Burnham-on-Sea and Highbridge</option>
                          <option value='Burnley'>Burnley</option>
                          <option value='Burntwood'>Burntwood</option>
                          <option value='Burslem'>Burslem</option>
                          <option value='Burton Latimer'>Burton Latimer</option>
                          <option value='Burton upon Trent'>Burton upon Trent</option>
                          <option value='Bury'>Bury</option>
                          <option value='Bury St Edmunds'>Bury St Edmunds</option>
                          <option value='Bushey'>Bushey</option>
                          <option value='Buxton'>Buxton</option>
                          <option value='Caistor'>Caistor</option>
                          <option value='Callington'>Callington</option>
                          <option value='Calne'>Calne</option>
                          <option value='Camborne'>Camborne</option>
                          <option value='Camelford'>Camelford</option>
                          <option value='Cannock'>Cannock</option>
                          <option value='Canvey Island'>Canvey Island</option>
                          <option value='Carlton Colville'>Carlton Colville</option>
                          <option value='Carnforth'>Carnforth</option>
                          <option value='Carshalton'>Carshalton</option>
                          <option value='Carterton'>Carterton</option>
                          <option value='Castle Cary'>Castle Cary</option>
                          <option value='Castleford'>Castleford</option>
                          <option value='Chagford'>Chagford</option>
                          <option value='Chapel-en-le-Frith'>Chapel-en-le-Frith</option>
                          <option value='Chard'>Chard</option>
                          <option value='Charlbury'>Charlbury</option>
                          <option value='Chatham'>Chatham</option>
                          <option value='Chatteris'>Chatteris</option>
                          <option value='Cheadle'>Cheadle</option>
                          <option value='Cheltenham'>Cheltenham</option>
                          <option value='Chertsey'>Chertsey</option>
                          <option value='Chesham'>Chesham</option>
                          <option value='Cheshunt'>Cheshunt</option>
                          <option value='Chesterfield'>Chesterfield</option>
                          <option value='Chester-le-Street'>Chester-le-Street</option>
                          <option value='Chickerell'>Chickerell</option>
                          <option value='Chingford'>Chingford</option>
                          <option value='Chippenham'>Chippenham</option>
                          <option value='Chipping Campden'>Chipping Campden</option>
                          <option value='Chipping Norton'>Chipping Norton</option>
                          <option value='Chipping Sodbury'>Chipping Sodbury</option>
                          <option value='Chorley'>Chorley</option>
                          <option value='Chorleywood'>Chorleywood</option>
                          <option value='Christchurch'>Christchurch</option>
                          <option value='Chudleigh'>Chudleigh</option>
                          <option value='Chulmleigh'>Chulmleigh</option>
                          <option value='Church Stretton'>Church Stretton</option>
                          <option value='Cinderford'>Cinderford</option>
                          <option value='Cirencester'>Cirencester</option>
                          <option value='Clare'>Clare</option>
                          <option value='Clay Cross'>Clay Cross</option>
                          <option value='Cleator Moor'>Cleator Moor</option>
                          <option value='Cleethorpes'>Cleethorpes</option>
                          <option value='Cleobury Mortimer'>Cleobury Mortimer</option>
                          <option value='Clevedon'>Clevedon</option>
                          <option value='Clitheroe'>Clitheroe</option>
                          <option value='Clun'>Clun</option>
                          <option value='Cockermouth'>Cockermouth</option>
                          <option value='Coggeshall'>Coggeshall</option>
                          <option value='Colburn'>Colburn</option>
                          <option value='Colchester'>Colchester</option>
                          <option value='Coleford'>Coleford</option>
                          <option value='Coleshill'>Coleshill</option>
                          <option value='Colne'>Colne</option>
                          <option value='Colyton'>Colyton</option>
                          <option value='Congleton'>Congleton</option>
                          <option value='Conisbrough'>Conisbrough</option>
                          <option value='Corbridge'>Corbridge</option>
                          <option value='Corby'>Corby</option>
                          <option value='Corringham'>Corringham</option>
                          <option value='Corsham'>Corsham</option>
                          <option value='Cotgrave'>Cotgrave</option>
                          <option value='Coulsdon'>Coulsdon</option>
                          <option value='Cowes'>Cowes</option>
                          <option value='Cramlington'>Cramlington</option>
                          <option value='Cranbrook'>Cranbrook</option>
                          <option value='Craven Arms'>Craven Arms</option>
                          <option value='Crawley'>Crawley</option>
                          <option value='Crediton'>Crediton</option>
                          <option value='Crewe'>Crewe</option>
                          <option value='Crewkerne'>Crewkerne</option>
                          <option value='Cricklade'>Cricklade</option>
                          <option value='Cromer'>Cromer</option>
                          <option value='Crosby'>Crosby</option>
                          <option value='Crowborough'>Crowborough</option>
                          <option value='Crowland'>Crowland</option>
                          <option value='Crowle'>Crowle</option>
                          <option value='Croydon'>Croydon</option>
                          <option value='Cullompton'>Cullompton</option>
                          <option value='Dagenham'>Dagenham</option>
                          <option value='Dalton Town with Newton'>Dalton Town with Newton</option>
                          <option value='Darley Dale'>Darley Dale</option>
                          <option value='Darlington'>Darlington</option>
                          <option value='Dartford'>Dartford</option>
                          <option value='Dartmouth'>Dartmouth</option>
                          <option value='Darwen'>Darwen</option>
                          <option value='Daventry'>Daventry</option>
                          <option value='Dawley'>Dawley</option>
                          <option value='Dawlish'>Dawlish</option>
                          <option value='Deal'>Deal</option>
                          <option value='Dereham'>Dereham</option>
                          <option value='Desborough'>Desborough</option>
                          <option value='Devizes'>Devizes</option>
                          <option value='Dewsbury'>Dewsbury</option>
                          <option value='Didcot'>Didcot</option>
                          <option value='Dinnington St John's'>Dinnington St John's</option>
                          <option value='Diss'>Diss</option>
                          <option value='Doncaster'>Doncaster</option>
                          <option value='Dorchester'>Dorchester</option>
                          <option value='Dorking'>Dorking</option>
                          <option value='Dover'>Dover</option>
                          <option value='Dovercourt'>Dovercourt</option>
                          <option value='Downham Market'>Downham Market</option>
                          <option value='Driffield'>Driffield</option>
                          <option value='Droitwich Spa'>Droitwich Spa</option>
                          <option value='Dronfield'>Dronfield</option>
                          <option value='Dudley'>Dudley</option>
                          <option value='Dukinfield'>Dukinfield</option>
                          <option value='Dulverton'>Dulverton</option>
                          <option value='Dunstable'>Dunstable</option>
                          <option value='Dunwich'>Dunwich</option>
                          <option value='Dursley'>Dursley</option>
                          <option value='Ealing'>Ealing</option>
                          <option value='Earl Shilton'>Earl Shilton</option>
                          <option value='Earley'>Earley</option>
                          <option value='Easingwold'>Easingwold</option>
                          <option value='East Cowes'>East Cowes</option>
                          <option value='East Grinstead'>East Grinstead</option>
                          <option value='East Ham'>East Ham</option>
                          <option value='East Retford'>East Retford</option>
                          <option value='Eastbourne'>Eastbourne</option>
                          <option value='Eastleigh'>Eastleigh</option>
                          <option value='Eastwood'>Eastwood</option>
                          <option value='Eccles'>Eccles</option>
                          <option value='Eccleshall'>Eccleshall</option>
                          <option value='Edenbridge'>Edenbridge</option>
                          <option value='Edgware'>Edgware</option>
                          <option value='Edmonton'>Edmonton</option>
                          <option value='Egremont'>Egremont</option>
                          <option value='Elland'>Elland</option>
                          <option value='Ellesmere'>Ellesmere</option>
                          <option value='Ellesmere Port'>Ellesmere Port</option>
                          <option value='Elstree and Borehamwood'>Elstree and Borehamwood</option>
                          <option value='Emsworth'>Emsworth</option>
                          <option value='Enfield'>Enfield</option>
                          <option value='Epping'>Epping</option>
                          <option value='Epworth'>Epworth</option>
                          <option value='Erith'>Erith</option>
                          <option value='Eton'>Eton</option>
                          <option value='Evesham'>Evesham</option>
                          <option value='Exmouth'>Exmouth</option>
                          <option value='Eye'>Eye</option>
                          <option value='Fairford'>Fairford</option>
                          <option value='Fakenham'>Fakenham</option>
                          <option value='Falmouth'>Falmouth</option>
                          <option value='Fareham'>Fareham</option>
                          <option value='Faringdon'>Faringdon</option>
                          <option value='Farnham'>Farnham</option>
                          <option value='Faversham'>Faversham</option>
                          <option value='Fazeley'>Fazeley</option>
                          <option value='Featherstone'>Featherstone</option>
                          <option value='Felixstowe'>Felixstowe</option>
                          <option value='Ferndown'>Ferndown</option>
                          <option value='Ferryhill'>Ferryhill</option>
                          <option value='Filey'>Filey</option>
                          <option value='Filton'>Filton</option>
                          <option value='Finchley'>Finchley</option>
                          <option value='Fleet'>Fleet</option>
                          <option value='Fleetwood'>Fleetwood</option>
                          <option value='Flitwick'>Flitwick</option>
                          <option value='Folkestone'>Folkestone</option>
                          <option value='Fordbridge'>Fordbridge</option>
                          <option value='Fordingbridge'>Fordingbridge</option>
                          <option value='Fordwich'>Fordwich</option>
                          <option value='Fowey'>Fowey</option>
                          <option value='Framlingham'>Framlingham</option>
                          <option value='Frinton and Walton'>Frinton and Walton</option>
                          <option value='Frodsham'>Frodsham</option>
                          <option value='Frome'>Frome</option>
                          <option value='Gainsborough'>Gainsborough</option>
                          <option value='Garstang'>Garstang</option>
                          <option value='Gateshead'>Gateshead</option>
                          <option value='Gillingham'>Gillingham</option>
                          <option value='Gillingham'>Gillingham</option>
                          <option value='Glastonbury'>Glastonbury</option>
                          <option value='Glossop'>Glossop</option>
                          <option value='Godalming'>Godalming</option>
                          <option value='Godmanchester'>Godmanchester</option>
                          <option value='Goole'>Goole</option>
                          <option value='Gorleston'>Gorleston</option>
                          <option value='Gosport'>Gosport</option>
                          <option value='Grange-over-Sands'>Grange-over-Sands</option>
                          <option value='Grantham'>Grantham</option>
                          <option value='Gravesend'>Gravesend</option>
                          <option value='Grays'>Grays</option>
                          <option value='Great Dunmow'>Great Dunmow</option>
                          <option value='Great Torrington'>Great Torrington</option>
                          <option value='Great Yarmouth'>Great Yarmouth</option>
                          <option value='Greater Willington'>Greater Willington</option>
                          <option value='Grimsby'>Grimsby</option>
                          <option value='Guildford'>Guildford</option>
                          <option value='Guisborough'>Guisborough</option>
                          <option value='Hadleigh'>Hadleigh</option>
                          <option value='Hailsham'>Hailsham</option>
                          <option value='Halesowen'>Halesowen</option>
                          <option value='Halesworth'>Halesworth</option>
                          <option value='Halifax'>Halifax</option>
                          <option value='Halstead'>Halstead</option>
                          <option value='Haltwhistle'>Haltwhistle</option>
                          <option value='Harlow'>Harlow</option>
                          <option value='Harpenden'>Harpenden</option>
                          <option value='Harrogate'>Harrogate</option>
                          <option value='Harrow'>Harrow</option>
                          <option value='Hartland'>Hartland</option>
                          <option value='Hartlepool'>Hartlepool</option>
                          <option value='Harwich'>Harwich</option>
                          <option value='Harworth and Bircotes'>Harworth and Bircotes</option>
                          <option value='Haslemere'>Haslemere</option>
                          <option value='Haslingden'>Haslingden</option>
                          <option value='Hastings'>Hastings</option>
                          <option value='Hatfield'>Hatfield</option>
                          <option value='Hatherleigh'>Hatherleigh</option>
                          <option value='Havant'>Havant</option>
                          <option value='Haverhill'>Haverhill</option>
                          <option value='Haxby'>Haxby</option>
                          <option value='Hayle'>Hayle</option>
                          <option value='Haywards Heath'>Haywards Heath</option>
                          <option value='Heanor and Loscoe'>Heanor and Loscoe</option>
                          <option value='Heathfield'>Heathfield</option>
                          <option value='Hebden Royd'>Hebden Royd</option>
                          <option value='Hedge End'>Hedge End</option>
                          <option value='Hednesford'>Hednesford</option>
                          <option value='Hedon'>Hedon</option>
                          <option value='Helmsley'>Helmsley</option>
                          <option value='Helston'>Helston</option>
                          <option value='Hemel Hempstead'>Hemel Hempstead</option>
                          <option value='Hemsworth'>Hemsworth</option>
                          <option value='Hendon'>Hendon</option>
                          <option value='Henley-in-Arden'>Henley-in-Arden</option>
                          <option value='Henley-on-Thames'>Henley-on-Thames</option>
                          <option value='Hertford'>Hertford</option>
                          <option value='Hessle'>Hessle</option>
                          <option value='Hetton'>Hetton</option>
                          <option value='Hexham'>Hexham</option>
                          <option value='Heywood'>Heywood</option>
                          <option value='High Wycombe'>High Wycombe</option>
                          <option value='Higham Ferrers'>Higham Ferrers</option>
                          <option value='Highworth'>Highworth</option>
                          <option value='Hinckley'>Hinckley</option>
                          <option value='Hingham'>Hingham</option>
                          <option value='Hitchin'>Hitchin</option>
                          <option value='Hoddesdon'>Hoddesdon</option>
                          <option value='Holbeach'>Holbeach</option>
                          <option value='Holsworthy'>Holsworthy</option>
                          <option value='Holt'>Holt</option>
                          <option value='Honiton'>Honiton</option>
                          <option value='Horley'>Horley</option>
                          <option value='Horncastle'>Horncastle</option>
                          <option value='Hornsea'>Hornsea</option>
                          <option value='Hornsey'>Hornsey</option>
                          <option value='Horsforth'>Horsforth</option>
                          <option value='Horsham'>Horsham</option>
                          <option value='Horwich'>Horwich</option>
                          <option value='Houghton Regis'>Houghton Regis</option>
                          <option value='Howden'>Howden</option>
                          <option value='Huddersfield'>Huddersfield</option>
                          <option value='Hungerford'>Hungerford</option>
                          <option value='Hunstanton'>Hunstanton</option>
                          <option value='Huntingdon'>Huntingdon</option>
                          <option value='Hyde'>Hyde</option>
                          <option value='Hythe'>Hythe</option>
                          <option value='Ilford'>Ilford</option>
                          <option value='Ilfracombe'>Ilfracombe</option>
                          <option value='Ilkeston'>Ilkeston</option>
                          <option value='Ilkley'>Ilkley</option>
                          <option value='Ilminster'>Ilminster</option>
                          <option value='Immingham'>Immingham</option>
                          <option value='Ingleby Barwick'>Ingleby Barwick</option>
                          <option value='Ipswich'>Ipswich</option>
                          <option value='Irthlingborough'>Irthlingborough</option>
                          <option value='Ivybridge'>Ivybridge</option>
                          <option value='Jarrow'>Jarrow</option>
                          <option value='Keighley'>Keighley</option>
                          <option value='Kempston'>Kempston</option>
                          <option value='Kendal'>Kendal</option>
                          <option value='Kenilworth'>Kenilworth</option>
                          <option value='Kesgrave'>Kesgrave</option>
                          <option value='Keswick'>Keswick</option>
                          <option value='Kettering'>Kettering</option>
                          <option value='Keynsham'>Keynsham</option>
                          <option value='Kidderminster'>Kidderminster</option>
                          <option value='Kidsgrove'>Kidsgrove</option>
                          <option value='Kimberley'>Kimberley</option>
                          <option value='King's Lynn'>King's Lynn</option>
                          <option value='Kingsbridge'>Kingsbridge</option>
                          <option value='Kingston-upon-Thames'>Kingston-upon-Thames</option>
                          <option value='Kington'>Kington</option>
                          <option value='Kirkby Lonsdale'>Kirkby Lonsdale</option>
                          <option value='Kirkby Stephen'>Kirkby Stephen</option>
                          <option value='Kirkby-in-Ashfield'>Kirkby-in-Ashfield</option>
                          <option value='Kirkbymoorside'>Kirkbymoorside</option>
                          <option value='Kirkham'>Kirkham</option>
                          <option value='Kirton-in-Lindsey'>Kirton-in-Lindsey</option>
                          <option value='Knaresborough'>Knaresborough</option>
                          <option value='Knutsford'>Knutsford</option>
                          <option value='Langport'>Langport</option>
                          <option value='Launceston'>Launceston</option>
                          <option value='Leatherhead'>Leatherhead</option>
                          <option value='Lechlade'>Lechlade</option>
                          <option value='Ledbury'>Ledbury</option>
                          <option value='Leek'>Leek</option>
                          <option value='Leigh'>Leigh</option>
                          <option value='Leigh-on-Sea'>Leigh-on-Sea</option>
                          <option value='Leighton-Linslade'>Leighton-Linslade</option>
                          <option value='Leiston'>Leiston</option>
                          <option value='Leominster'>Leominster</option>
                          <option value='Letchworth Garden City'>Letchworth Garden City</option>
                          <option value='Lewes'>Lewes</option>
                          <option value='Leyburn'>Leyburn</option>
                          <option value='Leyton'>Leyton</option>
                          <option value='Liskeard'>Liskeard</option>
                          <option value='Littlehampton'>Littlehampton</option>
                          <option value='Loddon'>Loddon</option>
                          <option value='Loftus'>Loftus</option>
                          <option value='Long Sutton'>Long Sutton</option>
                          <option value='Longridge'>Longridge</option>
                          <option value='Longtown'>Longtown</option>
                          <option value='Looe'>Looe</option>
                          <option value='Lostwithiel'>Lostwithiel</option>
                          <option value='Loughborough'>Loughborough</option>
                          <option value='Loughton'>Loughton</option>
                          <option value='Louth'>Louth</option>
                          <option value='Lowestoft'>Lowestoft</option>
                          <option value='Ludgershall'>Ludgershall</option>
                          <option value='Ludlow'>Ludlow</option>
                          <option value='Luton'>Luton</option>
                          <option value='Lutterworth'>Lutterworth</option>
                          <option value='Lydd'>Lydd</option>
                          <option value='Lydney'>Lydney</option>
                          <option value='Lyme Regis'>Lyme Regis</option>
                          <option value='Lynton and Lynmouth'>Lynton and Lynmouth</option>
                          <option value='Lytham St Annes'>Lytham St Annes</option>
                          <option value='Mablethorpe and Sutton'>Mablethorpe and Sutton</option>
                          <option value='Macclesfield'>Macclesfield</option>
                          <option value='Madeley'>Madeley</option>
                          <option value='Maghull'>Maghull</option>
                          <option value='Maidenhead'>Maidenhead</option>
                          <option value='Maidstone'>Maidstone</option>
                          <option value='Main article: New towns in the United Kingdom'>Main article: New towns in the United Kingdom</option>
                          <option value='Maldon'>Maldon</option>
                          <option value='Malmesbury'>Malmesbury</option>
                          <option value='Maltby'>Maltby</option>
                          <option value='Malton'>Malton</option>
                          <option value='Malvern'>Malvern</option>
                          <option value='Manningtree'>Manningtree</option>
                          <option value='Mansfield'>Mansfield</option>
                          <option value='Marazion'>Marazion</option>
                          <option value='March'>March</option>
                          <option value='Margate'>Margate</option>
                          <option value='Market Bosworth'>Market Bosworth</option>
                          <option value='Market Deeping'>Market Deeping</option>
                          <option value='Market Drayton'>Market Drayton</option>
                          <option value='Market Harborough'>Market Harborough</option>
                          <option value='Market Rasen'>Market Rasen</option>
                          <option value='Market Weighton'>Market Weighton</option>
                          <option value='Marlborough'>Marlborough</option>
                          <option value='Marlow'>Marlow</option>
                          <option value='Maryport'>Maryport</option>
                          <option value='Masham'>Masham</option>
                          <option value='Matlock'>Matlock</option>
                          <option value='Medlar with Wesham'>Medlar with Wesham</option>
                          <option value='Melksham'>Melksham</option>
                          <option value='Meltham'>Meltham</option>
                          <option value='Melton Mowbray'>Melton Mowbray</option>
                          <option value='Mere'>Mere</option>
                          <option value='Mexborough'>Mexborough</option>
                          <option value='Middleham'>Middleham</option>
                          <option value='Middlesbrough'>Middlesbrough</option>
                          <option value='Middleton'>Middleton</option>
                          <option value='Middlewich'>Middlewich</option>
                          <option value='Midhurst'>Midhurst</option>
                          <option value='Midsomer Norton'>Midsomer Norton</option>
                          <option value='Mildenhall'>Mildenhall</option>
                          <option value='Millom'>Millom</option>
                          <option value='Milton Keynes'>Milton Keynes</option>
                          <option value='Minchinhampton'>Minchinhampton</option>
                          <option value='Minehead'>Minehead</option>
                          <option value='Minster'>Minster</option>
                          <option value='Mirfield'>Mirfield</option>
                          <option value='Mitcham'>Mitcham</option>
                          <option value='Mitcheldean'>Mitcheldean</option>
                          <option value='Morecambe'>Morecambe</option>
                          <option value='Moretonhampstead'>Moretonhampstead</option>
                          <option value='Moreton-in-Marsh'>Moreton-in-Marsh</option>
                          <option value='Morley'>Morley</option>
                          <option value='Morpeth'>Morpeth</option>
                          <option value='Mossley'>Mossley</option>
                          <option value='Much Wenlock'>Much Wenlock</option>
                          <option value='Nailsea'>Nailsea</option>
                          <option value='Nailsworth'>Nailsworth</option>
                          <option value='Nantwich'>Nantwich</option>
                          <option value='Needham Market'>Needham Market</option>
                          <option value='Nelson'>Nelson</option>
                          <option value='Neston'>Neston</option>
                          <option value='New Alresford'>New Alresford</option>
                          <option value='New Mills'>New Mills</option>
                          <option value='New Milton'>New Milton</option>
                          <option value='New Romney'>New Romney</option>
                          <option value='Newark-on-Trent'>Newark-on-Trent</option>
                          <option value='Newbiggin-by-the-Sea'>Newbiggin-by-the-Sea</option>
                          <option value='Newbury'>Newbury</option>
                          <option value='Newcastle-under-Lyme'>Newcastle-under-Lyme</option>
                          <option value='Newent'>Newent</option>
                          <option value='Newhaven'>Newhaven</option>
                          <option value='Newlyn'>Newlyn</option>
                          <option value='Newmarket'>Newmarket</option>
                          <option value='Newport'>Newport</option>
                          <option value='Newport'>Newport</option>
                          <option value='Newport Pagnell'>Newport Pagnell</option>
                          <option value='Newquay'>Newquay</option>
                          <option value='Newton Abbot'>Newton Abbot</option>
                          <option value='Newton-le-Willows'>Newton-le-Willows</option>
                          <option value='Normanton'>Normanton</option>
                          <option value='North Hykeham'>North Hykeham</option>
                          <option value='North Petherton'>North Petherton</option>
                          <option value='North Tawton'>North Tawton</option>
                          <option value='North Walsham'>North Walsham</option>
                          <option value='Northallerton'>Northallerton</option>
                          <option value='Northam'>Northam</option>
                          <option value='Northampton'>Northampton</option>
                          <option value='Northfleet'>Northfleet</option>
                          <option value='Northleach with Eastington'>Northleach with Eastington</option>
                          <option value='Northwich'>Northwich</option>
                          <option value='Norton-on-Derwent'>Norton-on-Derwent</option>
                          <option value='Nuneaton'>Nuneaton</option>
                          <option value='Oakengates'>Oakengates</option>
                          <option value='Oakham'>Oakham</option>
                          <option value='Okehampton'>Okehampton</option>
                          <option value='Oldbury'>Oldbury</option>
                          <option value='Oldham'>Oldham</option>
                          <option value='Ollerton and Boughton'>Ollerton and Boughton</option>
                          <option value='Olney'>Olney</option>
                          <option value='Ongar'>Ongar</option>
                          <option value='Orford'>Orford</option>
                          <option value='Ormskirk'>Ormskirk</option>
                          <option value='Ossett'>Ossett</option>
                          <option value='Oswestry'>Oswestry</option>
                          <option value='Otley'>Otley</option>
                          <option value='Ottery St Mary'>Ottery St Mary</option>
                          <option value='Oundle'>Oundle</option>
                          <option value='Paddock Wood'>Paddock Wood</option>
                          <option value='Padiham'>Padiham</option>
                          <option value='Padstow'>Padstow</option>
                          <option value='Paignton'>Paignton</option>
                          <option value='Painswick'>Painswick</option>
                          <option value='Partington'>Partington</option>
                          <option value='Patchway'>Patchway</option>
                          <option value='Pateley Bridge'>Pateley Bridge</option>
                          <option value='Peacehaven'>Peacehaven</option>
                          <option value='Penistone'>Penistone</option>
                          <option value='Penkridge'>Penkridge</option>
                          <option value='Penrith'>Penrith</option>
                          <option value='Penryn'>Penryn</option>
                          <option value='Penwortham'>Penwortham</option>
                          <option value='Penzance'>Penzance</option>
                          <option value='Pershore'>Pershore</option>
                          <option value='Peterlee'>Peterlee</option>
                          <option value='Petersfield'>Petersfield</option>
                          <option value='Petworth'>Petworth</option>
                          <option value='Pickering'>Pickering</option>
                          <option value='Pocklington'>Pocklington</option>
                          <option value='Polegate'>Polegate</option>
                          <option value='Pontefract'>Pontefract</option>
                          <option value='Ponteland'>Ponteland</option>
                          <option value='Poole'>Poole</option>
                          <option value='Porthleven'>Porthleven</option>
                          <option value='Portishead and North Weston'>Portishead and North Weston</option>
                          <option value='Portland'>Portland</option>
                          <option value='Potton'>Potton</option>
                          <option value='Poynton-with-Worth'>Poynton-with-Worth</option>
                          <option value='Preesall'>Preesall</option>
                          <option value='Prescot'>Prescot</option>
                          <option value='Princes Risborough'>Princes Risborough</option>
                          <option value='Prudhoe'>Prudhoe</option>
                          <option value='Pudsey'>Pudsey</option>
                          <option value='Queenborough-in-Sheppey'>Queenborough-in-Sheppey</option>
                          <option value='Radstock'>Radstock</option>
                          <option value='Ramsey'>Ramsey</option>
                          <option value='Ramsgate'>Ramsgate</option>
                          <option value='Raunds'>Raunds</option>
                          <option value='Rawtenstall'>Rawtenstall</option>
                          <option value='Rayleigh'>Rayleigh</option>
                          <option value='Reading'>Reading</option>
                          <option value='Redcar'>Redcar</option>
                          <option value='Redditch'>Redditch</option>
                          <option value='Redenhall with Harleston'>Redenhall with Harleston</option>
                          <option value='Redruth'>Redruth</option>
                          <option value='Reepham'>Reepham</option>
                          <option value='Reigate'>Reigate</option>
                          <option value='Richmond'>Richmond</option>
                          <option value='Richmond'>Richmond</option>
                          <option value='Ringwood'>Ringwood</option>
                          <option value='Ripley'>Ripley</option>
                          <option value='Ripon'>Ripon</option>
                          <option value='Rochdale'>Rochdale</option>
                          <option value='Rochester'>Rochester</option>
                          <option value='Rochford'>Rochford</option>
                          <option value='Romford'>Romford</option>
                          <option value='Romsey'>Romsey</option>
                          <option value='Ross-on-Wye'>Ross-on-Wye</option>
                          <option value='Rothbury'>Rothbury</option>
                          <option value='Rotherham'>Rotherham</option>
                          <option value='Rothwell'>Rothwell</option>
                          <option value='Rothwell'>Rothwell</option>
                          <option value='Rowley Regis'>Rowley Regis</option>
                          <option value='Royal Leamington Spa'>Royal Leamington Spa</option>
                          <option value='Royal Tunbridge Wells'>Royal Tunbridge Wells</option>
                          <option value='Royal Wootton Bassett'>Royal Wootton Bassett</option>
                          <option value='Royston'>Royston</option>
                          <option value='Rugby'>Rugby</option>
                          <option value='Rugeley'>Rugeley</option>
                          <option value='Rushden'>Rushden</option>
                          <option value='Ryde'>Ryde</option>
                          <option value='Rye'>Rye</option>
                          <option value='Saffron Walden'>Saffron Walden</option>
                          <option value='Salcombe'>Salcombe</option>
                          <option value='Sale'>Sale</option>
                          <option value='Saltash'>Saltash</option>
                          <option value='Sandbach'>Sandbach</option>
                          <option value='Sandhurst'>Sandhurst</option>
                          <option value='Sandiacre'>Sandiacre</option>
                          <option value='Sandown'>Sandown</option>
                          <option value='Sandwich'>Sandwich</option>
                          <option value='Sandy'>Sandy</option>
                          <option value='Sawbridgeworth'>Sawbridgeworth</option>
                          <option value='Saxmundham'>Saxmundham</option>
                          <option value='Scarborough'>Scarborough</option>
                          <option value='Scunthorpe'>Scunthorpe</option>
                          <option value='Seaford'>Seaford</option>
                          <option value='Seaham'>Seaham</option>
                          <option value='Seaton'>Seaton</option>
                          <option value='Sedbergh'>Sedbergh</option>
                          <option value='Selby'>Selby</option>
                          <option value='Selsey'>Selsey</option>
                          <option value='Settle'>Settle</option>
                          <option value='Sevenoaks'>Sevenoaks</option>
                          <option value='Shaftesbury'>Shaftesbury</option>
                          <option value='Shanklin'>Shanklin</option>
                          <option value='Shefford'>Shefford</option>
                          <option value='Shepshed'>Shepshed</option>
                          <option value='Shepton Mallet'>Shepton Mallet</option>
                          <option value='Sherborne'>Sherborne</option>
                          <option value='Sheringham'>Sheringham</option>
                          <option value='Shifnal'>Shifnal</option>
                          <option value='Shildon'>Shildon</option>
                          <option value='Shipston-on-Stour'>Shipston-on-Stour</option>
                          <option value='Shirebrook'>Shirebrook</option>
                          <option value='Shoreham-by-Sea'>Shoreham-by-Sea</option>
                          <option value='Shrewsbury'>Shrewsbury</option>
                          <option value='Sidmouth'>Sidmouth</option>
                          <option value='Silloth'>Silloth</option>
                          <option value='Silsden'>Silsden</option>
                          <option value='Sittingbourne'>Sittingbourne</option>
                          <option value='Skegness'>Skegness</option>
                          <option value='Skelmersdale'>Skelmersdale</option>
                          <option value='Skelton-in-Cleveland'>Skelton-in-Cleveland</option>
                          <option value='Skipton'>Skipton</option>
                          <option value='Sleaford'>Sleaford</option>
                          <option value='Slough'>Slough</option>
                          <option value='Smethwick'>Smethwick</option>
                          <option value='Snaith and Cowick'>Snaith and Cowick</option>
                          <option value='Snodland'>Snodland</option>
                          <option value='Soham'>Soham</option>
                          <option value='Solihull'>Solihull</option>
                          <option value='Somerton'>Somerton</option>
                          <option value='South Cave'>South Cave</option>
                          <option value='South Elmsall'>South Elmsall</option>
                          <option value='South Kirkby and Moorthorpe'>South Kirkby and Moorthorpe</option>
                          <option value='South Molton'>South Molton</option>
                          <option value='South Petherton'>South Petherton</option>
                          <option value='South Shields'>South Shields</option>
                          <option value='South Woodham Ferrers'>South Woodham Ferrers</option>
                          <option value='Southall'>Southall</option>
                          <option value='Southam'>Southam</option>
                          <option value='Southborough'>Southborough</option>
                          <option value='Southend-on-Sea'>Southend-on-Sea</option>
                          <option value='Southgate'>Southgate</option>
                          <option value='Southminster'>Southminster</option>
                          <option value='Southport'>Southport</option>
                          <option value='Southsea'>Southsea</option>
                          <option value='Southwell'>Southwell</option>
                          <option value='Southwick'>Southwick</option>
                          <option value='Southwold'>Southwold</option>
                          <option value='Spalding'>Spalding</option>
                          <option value='Spennymoor'>Spennymoor</option>
                          <option value='Spilsby'>Spilsby</option>
                          <option value='St Austell'>St Austell</option>
                          <option value='St Blaise'>St Blaise</option>
                          <option value='St Columb Major'>St Columb Major</option>
                          <option value='St Helens'>St Helens</option>
                          <option value='St Ives'>St Ives</option>
                          <option value='St Ives'>St Ives</option>
                          <option value='St Just-in-Penwith'>St Just-in-Penwith</option>
                          <option value='St Mary Cray'>St Mary Cray</option>
                          <option value='St Mawes'>St Mawes</option>
                          <option value='St Neots'>St Neots</option>
                          <option value='Stafford'>Stafford</option>
                          <option value='Staines-upon-Thames'>Staines-upon-Thames</option>
                          <option value='Stainforth'>Stainforth</option>
                          <option value='Stalbridge'>Stalbridge</option>
                          <option value='Stalham'>Stalham</option>
                          <option value='Stalybridge'>Stalybridge</option>
                          <option value='Stamford'>Stamford</option>
                          <option value='Stanhope'>Stanhope</option>
                          <option value='Stanley'>Stanley</option>
                          <option value='Stapleford'>Stapleford</option>
                          <option value='Staveley'>Staveley</option>
                          <option value='Stevenage'>Stevenage</option>
                          <option value='Steyning'>Steyning</option>
                          <option value='Stockport'>Stockport</option>
                          <option value='Stocksbridge'>Stocksbridge</option>
                          <option value='Stockton-on-Tees'>Stockton-on-Tees</option>
                          <option value='Stone'>Stone</option>
                          <option value='Stonehouse'>Stonehouse</option>
                          <option value='Stony Stratford'>Stony Stratford</option>
                          <option value='Stotfold'>Stotfold</option>
                          <option value='Stourbridge'>Stourbridge</option>
                          <option value='Stourport-on-Severn'>Stourport-on-Severn</option>
                          <option value='Stowmarket'>Stowmarket</option>
                          <option value='Stow-on-the-Wold'>Stow-on-the-Wold</option>
                          <option value='Stratford-upon-Avon'>Stratford-upon-Avon</option>
                          <option value='Stretford'>Stretford</option>
                          <option value='Strood'>Strood</option>
                          <option value='Stroud'>Stroud</option>
                          <option value='Sturminster Newton'>Sturminster Newton</option>
                          <option value='Sudbury'>Sudbury</option>
                          <option value='Surbiton'>Surbiton</option>
                          <option value='Sutton'>Sutton</option>
                          <option value='Sutton Coldfield'>Sutton Coldfield</option>
                          <option value='Swaffham'>Swaffham</option>
                          <option value='Swanage'>Swanage</option>
                          <option value='Swanley'>Swanley</option>
                          <option value='Swanscombe and Greenhithe'>Swanscombe and Greenhithe</option>
                          <option value='Swindon'>Swindon</option>
                          <option value='Syston'>Syston</option>
                          <option value='Tadcaster'>Tadcaster</option>
                          <option value='Tadley'>Tadley</option>
                          <option value='Tamworth'>Tamworth</option>
                          <option value='Taunton'>Taunton</option>
                          <option value='Tavistock'>Tavistock</option>
                          <option value='Teignmouth'>Teignmouth</option>
                          <option value='Telford'>Telford</option>
                          <option value='Telscombe'>Telscombe</option>
                          <option value='Tenbury Wells'>Tenbury Wells</option>
                          <option value='Tenterden'>Tenterden</option>
                          <option value='Tetbury'>Tetbury</option>
                          <option value='Tewkesbury'>Tewkesbury</option>
                          <option value='Thame'>Thame</option>
                          <option value='Thatcham'>Thatcham</option>
                          <option value='Thaxted'>Thaxted</option>
                          <option value='Thetford'>Thetford</option>
                          <option value='Thirsk'>Thirsk</option>
                          <option value='Thornaby-on-Tees'>Thornaby-on-Tees</option>
                          <option value='Thornbury'>Thornbury</option>
                          <option value='Thorne'>Thorne</option>
                          <option value='Thorpe St Andrew'>Thorpe St Andrew</option>
                          <option value='Thrapston'>Thrapston</option>
                          <option value='Tickhill'>Tickhill</option>
                          <option value='Tidworth'>Tidworth</option>
                          <option value='Tipton'>Tipton</option>
                          <option value='Tisbury'>Tisbury</option>
                          <option value='Tiverton'>Tiverton</option>
                          <option value='Todmorden'>Todmorden</option>
                          <option value='Tonbridge'>Tonbridge</option>
                          <option value='Topsham'>Topsham</option>
                          <option value='Torpoint'>Torpoint</option>
                          <option value='Torquay'>Torquay</option>
                          <option value='Totnes'>Totnes</option>
                          <option value='Tottenham'>Tottenham</option>
                          <option value='Totton and Eling'>Totton and Eling</option>
                          <option value='Tow Law'>Tow Law</option>
                          <option value='Towcester'>Towcester</option>
                          <option value='Tring'>Tring</option>
                          <option value='Trowbridge'>Trowbridge</option>
                          <option value='Twickenham'>Twickenham</option>
                          <option value='Tynemouth'>Tynemouth</option>
                          <option value='Uckfield'>Uckfield</option>
                          <option value='Ulverston'>Ulverston</option>
                          <option value='Uppingham'>Uppingham</option>
                          <option value='Upton-upon-Severn'>Upton-upon-Severn</option>
                          <option value='Uttoxeter'>Uttoxeter</option>
                          <option value='Uxbridge'>Uxbridge</option>
                          <option value='Ventnor'>Ventnor</option>
                          <option value='Verwood'>Verwood</option>
                          <option value='Wadebridge'>Wadebridge</option>
                          <option value='Wadhurst'>Wadhurst</option>
                          <option value='Wainfleet All Saints'>Wainfleet All Saints</option>
                          <option value='Wallasey'>Wallasey</option>
                          <option value='Wallingford'>Wallingford</option>
                          <option value='Wallsend'>Wallsend</option>
                          <option value='Walsall'>Walsall</option>
                          <option value='Waltham Abbey'>Waltham Abbey</option>
                          <option value='Waltham Cross'>Waltham Cross</option>
                          <option value='Walthamstow'>Walthamstow</option>
                          <option value='Walton-on-Thames'>Walton-on-Thames</option>
                          <option value='Wantage'>Wantage</option>
                          <option value='Ware'>Ware</option>
                          <option value='Wareham'>Wareham</option>
                          <option value='Warminster'>Warminster</option>
                          <option value='Warrington'>Warrington</option>
                          <option value='Warwick'>Warwick</option>
                          <option value='Washington'>Washington</option>
                          <option value='Watchet'>Watchet</option>
                          <option value='Watford'>Watford</option>
                          <option value='Wath-upon-Dearne'>Wath-upon-Dearne</option>
                          <option value='Watlington'>Watlington</option>
                          <option value='Watton'>Watton</option>
                          <option value='Wellingborough'>Wellingborough</option>
                          <option value='Wellington'>Wellington</option>
                          <option value='Wellington'>Wellington</option>
                          <option value='Wells-next-the-Sea'>Wells-next-the-Sea</option>
                          <option value='Welwyn Garden City'>Welwyn Garden City</option>
                          <option value='Wem'>Wem</option>
                          <option value='Wembley'>Wembley</option>
                          <option value='Wendover'>Wendover</option>
                          <option value='West Bedlington'>West Bedlington</option>
                          <option value='West Bromwich'>West Bromwich</option>
                          <option value='West Ham'>West Ham</option>
                          <option value='West Malling'>West Malling</option>
                          <option value='West Mersea'>West Mersea</option>
                          <option value='West Tilbury'>West Tilbury</option>
                          <option value='Westbury'>Westbury</option>
                          <option value='Westerham'>Westerham</option>
                          <option value='Westhoughton'>Westhoughton</option>
                          <option value='Weston-super-Mare'>Weston-super-Mare</option>
                          <option value='Wetherby'>Wetherby</option>
                          <option value='Weybridge'>Weybridge</option>
                          <option value='Weymouth'>Weymouth</option>
                          <option value='Whaley Bridge'>Whaley Bridge</option>
                          <option value='Whitby'>Whitby</option>
                          <option value='Whitchurch'>Whitchurch</option>
                          <option value='Whitchurch'>Whitchurch</option>
                          <option value='Whitehaven'>Whitehaven</option>
                          <option value='Whitehill'>Whitehill</option>
                          <option value='Whitnash'>Whitnash</option>
                          <option value='Whittlesey'>Whittlesey</option>
                          <option value='Whitworth'>Whitworth</option>
                          <option value='Wickham'>Wickham</option>
                          <option value='Wickwar'>Wickwar</option>
                          <option value='Widnes'>Widnes</option>
                          <option value='Wigan'>Wigan</option>
                          <option value='Wigton'>Wigton</option>
                          <option value='Willenhall'>Willenhall</option>
                          <option value='Willesden'>Willesden</option>
                          <option value='Wilton'>Wilton</option>
                          <option value='Wimbledon'>Wimbledon</option>
                          <option value='Wimborne Minster'>Wimborne Minster</option>
                          <option value='Wincanton'>Wincanton</option>
                          <option value='Winchcombe'>Winchcombe</option>
                          <option value='Winchelsea'>Winchelsea</option>
                          <option value='Windermere'>Windermere</option>
                          <option value='Windsor'>Windsor</option>
                          <option value='Winsford'>Winsford</option>
                          <option value='Winslow'>Winslow</option>
                          <option value='Winterton'>Winterton</option>
                          <option value='Wirksworth'>Wirksworth</option>
                          <option value='Wisbech'>Wisbech</option>
                          <option value='Witham'>Witham</option>
                          <option value='Withernsea'>Withernsea</option>
                          <option value='Witney'>Witney</option>
                          <option value='Wiveliscombe'>Wiveliscombe</option>
                          <option value='Wivenhoe'>Wivenhoe</option>
                          <option value='Woburn'>Woburn</option>
                          <option value='Woburn Sands'>Woburn Sands</option>
                          <option value='Woking'>Woking</option>
                          <option value='Wokingham'>Wokingham</option>
                          <option value='Wolsingham'>Wolsingham</option>
                          <option value='Wolverton and Greenleys'>Wolverton and Greenleys</option>
                          <option value='Wood Green'>Wood Green</option>
                          <option value='Woodbridge'>Woodbridge</option>
                          <option value='Woodley'>Woodley</option>
                          <option value='Woodstock'>Woodstock</option>
                          <option value='Wooler'>Wooler</option>
                          <option value='Workington'>Workington</option>
                          <option value='Worksop'>Worksop</option>
                          <option value='Worthing'>Worthing</option>
                          <option value='Wotton-under-Edge'>Wotton-under-Edge</option>
                          <option value='Wragby'>Wragby</option>
                          <option value='Wymondham'>Wymondham</option>
                          <option value='Yarm'>Yarm</option>
                          <option value='Yarmouth'>Yarmouth</option>
                          <option value='Yate'>Yate</option>
                          <option value='Yateley'>Yateley</option>
                          <option value='Yeovil'>Yeovil</option>
                        </select>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label for="postcode">Postcode</label>
                        <input type="text" class="form-control" id="postcode" placeholder="HR12BP" name="postcode" value="{{ old ('postcode') }}">
                      </div>

                      <div class="col-md-3 mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" placeholder="07457197816" name="phone" value="{{ old ('phone') }}">
                      </div>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Payment Information</h4>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="name_on_card">Name on card</label>
                        <input type="text" class="form-control" id="name_on_card" placeholder="MR C JAMES" name="name_on_card" value="{{ old ('name_on_card') }}">
                        <small class="text-muted">Full name as displayed on card</small>
                      </div>

                    </div>
                    {{-- STRIPE Payment form gets tags from the js --}}
                    <div class="row">
                      <div class="col-md-12 mb-6">
                        <label for="card-element">
                          Credit or debit card
                      </label>
                      <div id="card-element">
                          <!-- A Stripe Element will be inserted here. -->
                      </div>
                  
                      <!-- Used to display form errors. -->
                      <div id="card-errors" role="alert"></div>
                      </div>
                    </div>
                    {{-- end of STRIPE payment --}}
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" id="disable-button" >Confirm Your Order</button>
                  </form>
                </div>
              {{-- end of checkout form --}}
            </div>
        </div>
@endsection

@section('extra-js')
    <script src="https://js.stripe.com/v3/"></script>
    <script> 
        // ensure all the content is loaded and then run the below javascript
         document.addEventListener('DOMContentLoaded', function () {
                        // Create a Stripe client.
            var stripe = Stripe('pk_test_h3CcIJurHplCOZu6M1RaFoGr00wGJMcAIS');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true
                });

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
            event.preventDefault();

            //to disable the user from clicking twice and it place charging the customer twice, prevent the default button
            document.getElementById('disable-button').disabled = true;

            //this object grabs the data from the form input fields and stores in the below object
            var options = {
                name:               document.getElementById('name_on_card').value,
                address_line1:     document.getElementById('address').value,
                address_city:       document.getElementById('city').value,
                address_zip:        document.getElementById('postcode').value
                
            }

            stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                
                //enable the submit button
               document.getElementById('disable-button').disabled = false;

                } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
                }
            });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
            }
        });
    </script>
@endsection
    