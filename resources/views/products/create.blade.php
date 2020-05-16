@can('list-edit-products')

@extends('layouts.app')

@section ('index')

<div class="row">
    <div class="col-md-2" id="create_page_ads">
        <div class="card" >
            <div class="card-header">
              Featured Ads
            </div>
            <div class="card-body">
              <h5 class="card-title">Dell.com</h5>
              <p class="card-text">Find amazing deals here</p>
            </div>
            <hr>
            <div class="card-body">
                <h5 class="card-title">Apple.com</h5>
                <p class="card-text">Click on me to get exclusive deals</p>
            </div>
        </div>
    </div>

    <div class="col-md-10">
        <div class="container">
            <div class="row d-flex justify-content-center" >
                <div class="col-md-11" id="create_page">
                    <form method="POST" action="/products" id="create_products_form" enctype="multipart/form-data">
                        @csrf
                
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Book Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="name of the book">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="author">Book Author</label>
                            <input type="text" class="form-control" name="author" id="author">
                        </div>
                        </div>
                
                        <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="please describe the book in a few words...."></textarea>
                        </div>
                
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="publisher">Book Publisher</label>
                                <input type="text" class="form-control" name="publisher" id="publisher">
                            </div>
                
                            <div class="form-group col-md-4">
                                <label for="ISBN_NO">International Standard Book Number</label>
                                <input type="text" class="form-control" name="ISBN_NO" id="ISBN_NO" placeholder="978-3-16-148410-0">
                            </div>
                
                            <div class="form-group col-md-4">
                                <label for="weight">Weight of Book</label>
                                <input class="form-control"  type="number" name="weight" id="weight" placeholder='Enter weight in KG'>
                            </div>
                        </div>
                
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pages">Pages</label>
                            <input class="form-control" type="number" name="pages" id="pages" placeholder='Enter total number of pages'>
                        </div>
                
                
                        <div class="form-group col-md-4">
                            <label for="quantity">Quantity</label>
                            <input class="form-control" type="number" name="quantity" id="quantity"  placeholder='if > 1, then ensure books have the same condition'>
                            </select>
                        </div>
                
                        <div class="form-group col-md-2">
                            <label for="price">Price</label>
                            <input  class="form-control" type="number" name="price" id="price" placeholder="GBP">
                        </div>
                        </div>
                
                
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="published_date">Date Published</label>
                                <input  class="form-control" type="date" name= "published_date" placeholder="enter year the book was published at">
                            </div>
                
                            <div class="form-group col-md-6">
                                <label for="condition">Condition</label>
                                {{-- select allows me to create a dropdown --}}
                                {{-- option allows --}}
                                <select name="conditionselect" id="condition" class="form-control input-lg dynamic" data-dependent="labSubCat">
                                    <option value="{{$conditions}}">Select Condition</option>
                                        @foreach($conditions as $co)
                                            <option value="{{$co->name}}">{{$co->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                
                
                        <div class="form-group">
                            {{-- select allows me to create a dropdown --}}
                            {{-- option allows to display individual values from the dropdown --}}
                            <label class="categories">Select Category</label>
                            <select name="categories1[]" id="categories" class="form-control input-lg dynamic" data-dependent="labSubCat" multiple>
                            <option value="{{$categories}}" disabled selected>Select Category <small class="text-muted">Ctrl + click for multiple categories</small></option>
                                @foreach($categories as $ca)
                                    <option value="{{$ca->id}}">{{$ca->name}}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                {{-- for user to upload thumbnail and multiple product images --}}
                                    <label class="label" for="imagecollection"> Product Thumbnail </label>
                                    <input type="file" class="form-control" name="thumbnail" required>
                            </div>
                
                            <div class="form-group col-md-6">
                                    <label class="label" for="imagecollection"> Product Images <small class="text-muted">Ctrl + click on multiple images</small> </label>
                                    <input type="file" class="form-control" name="images[]"  multiple required>
                            </div>
                
                        </div>
                        <button  class="button is-link" type="submit" id="disable-button">Click to Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- to disable the submit button once if the user click on it  --}}
@section('extra-js')
        <script type="text/javascript">
         document.addEventListener('DOMContentLoaded', function () {
                $(document).ready(function () {
                $("#create_products_form").submit(function (e) {
                    $("#disable-button").attr("disabled", true);
                    return true;
                });
            });
        });
        </script>
@endsection
@endcan