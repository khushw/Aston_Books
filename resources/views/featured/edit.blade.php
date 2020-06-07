@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Set Featured: {{$product->title}}</div>
              
            {{-- for the admin to change the users email --}}
                <div class="card-body">
                    <form action="{{route('featured.update' , $product->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        {{-- use this method as most browsers only support POST so laravel provides a way around it --} --}}
                        <div class="form-group row">    
                            <label for="featured" class="col-md-2 col-form-label text-md-right">Featured</label>
                            <div class="col-md-6">
                                    <div class="form-check">
                                           {{-- @if($product->featured == 0)
                                            <input type="checkbox" id="featured" name="featured" value="0" checked>
                                            <label for="featured">False</label><br>
                                            <input type="checkbox" id="featured" name="featured" value="1">
                                            <label for="featured">True</label><br>
                                            @elseif($product->featured == 1)
                                            <input type="checkbox" id="featured" name="featured" value="0">
                                            <label for="featured">False</label><br>
                                            <input type="checkbox" id="featured" name="featured" value="1" checked>
                                            <label for="featured">True</label><br>
                                            @endif --}}
                                            <select class="form-control" name="featured">
                                                <option value="1" @if ($product->featured == 1) selected @endif>True</option>
                                                <option value="0" @if ($product->featured == 0) selected @endif>False</option>
                                            </select>
                                        {{-- @endif --}}
                                    </div>                         
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection