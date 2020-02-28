@extends('layouts.app')

@section ('content')
{{--  --}}

        <div class="container">
            <h1 class="checkout-heading stylish-heading"> Checkout </h1>
            <div class="checkout-section">
                <div>
                    <form action="{{route('checkout.store')}}" method="POST" id="payment-form">
                         {{ csrf_field() }}
                        <h2> Shipping Details </h2>
                        
                            <div class="form-group">
                            <label for="email"> Email Address </label>
                            <input type="email"  class="form-control" id="email" name="email" value="{{$email}}">
                        </div>

                        <div class="form-group">
                            <label for="name"> Name </label>
                            <input type="text"  class="form-control" id="name" name="name" value="{{$name}}">
                        </div>

                        <div class="form-group">
                            <label for="address"> Address </label>
                            <input type="text"  class="form-control" id="address" name="address" value="{{ old ('address') }}">
                        </div>

                        <div class="half-form">
                            <label for="city"> City </label>
                            <input type="text"  class="form-control" id="city" name="city" value="{{ old ('city') }}">
                        </div>
                        
                        <div class="form-form">
                            <label for="postcode"> Postcode </label>
                            <input type="text"  class="form-control" id="postcode" name="postcode" value="{{ old ('postcode') }}">
                        </div>
                        
                        <div class="form-form">
                            <label for="phone"> Phone </label>
                            <input type="text"  class="form-control" id="phone" name="phone" value="{{ old ('phone') }}">
                        </div>

                        <div class="spacer"></div>

                        <h2> Payment Details </h2>

                        <div class="form-group">
                            <label for="name_on_card"> Name on Card </label>
                            <input type="text"  class="form-control" id="name_on_card" name="name_on_card" value="{{ old ('name_on_card') }}">
                        </div>

                        {{-- <div class="form-group">
                            <label for="address"> Address </label>
                            <input type="text"  class="form-control" id="address" name="address" value="{{ old ('address') }}">
                        </div> --}}

                        {{-- STRIPE payment method input fields for the user card details --}}
                        <div class="form-group">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                        
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div> 

                        {{-- <div class="form-group">
                            <label for="cc-number"> Credit Card Number </label>
                            <input type="text"  class="form-control" id="cc-number" name="cc-number" value="">
                        </div> --}}

                        {{-- start of half form  --}}
                        {{-- <div class="half-form">
                           
                            <div class="form-group">
                                <label for="expiry"> Expiry </label>
                                <input type="text"  class="form-control" id="expiry" name="expiry" value="">
                            </div>

                            
                            <div class="form-group">
                                <label for="cvc"> CVC Code </label>
                                <input type="text"  class="form-control" id="cvc" name="cvc" value="">
                            </div>
                        </div>  --}}
                      

                        <div class="spacer"></div>

                        <button type="submit" id="disable-button" class="button-primary full-width"> Complete Purchase </button>

                    </form>
                </div>

                <div class="checkout-table-container">
                    <h2> Your Order</h2>
                    <div class="checkout-table">
                        @foreach (Cart::content() as $item)
                            <div class="checkout-table-row">
                                <div class="checkout-table-row-left">
                                    <img src="#" alt="item" class="checkout-table-img">
                                    <div class="checkout-item-details">
                                        <div class="checkout-table-item"> Title:{{$item->model->title}} </div>
                                        <div class="checkout-table-description">  Description:{{$item->model->description}} </div>
                                        <div class="checkout-table-price"> Price:${{$item->model->price}} </div>      
                                    </div>                                
                                </div>  
                                {{-- end of checkout table row left --}}
                                <div class="checkout-table-row-right">
                                    <div class="checkout-table-quantity"> {{$item->qty}} </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="checkout-table-row">
                            <div class="checkout-table-row-left">
                            
                            </div>
                        </div>

                        <div class="checkout-totals">
                            <div class="checkout-totals-left">
                                {{-- Discount Codes etc --}}
                            {{-- <span class="checkout-totals-total"> Discount Toatal<br></span> --}}
                            </div>
                        </div>
                        
                        <div class="checkout-totals">
                            <div class="checkout-totals-right">
                               Subtotal  {{Cart::subtotal()}}<br>
                                Tax {{Cart::tax()}}<br>
                            <span class="checkout-totals-total"> Total {{Cart::total()}}<br></span>
                            </div>
                        </div>

                    </div>
                </div>

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
    