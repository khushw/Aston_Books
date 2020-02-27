@extends('layouts.app')
@section('content')
<form action="{{route('review.update', $review->id)}}" method="POST"> <br>
    @csrf
      @method('PATCH')
    <label class="label" for="body">User Reviews</label><br>
     <div class="field">
          <label class="label" for="body">Please enter your experience</label>
          <div class="control">
              <input class="input" type="text" name="body" id="body" value="{{$review->body}}"> 
          </div>
      </div>
      <div class="field">
          <label class="label" for="rating">Give this product a rating</label>
          <div class="control">
                <select class="input" type="number" name="rating">  
                    @for ($i = 1; $i <= 5 ; $i++)
                        <option {{$review->rating == $i ? 'selected' : ''}}>{{$i}}</option>    
                    @endfor 
                </select>
            </div>
      </div>
     <button type="submit" class="button button-plain"> Update </button>
</form>
@endsection