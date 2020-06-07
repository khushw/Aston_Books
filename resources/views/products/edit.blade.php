@can('list-edit-products')
@extends('layouts.app')

@section ('content')
<h1>Edit Product Information</h1>
    
        {{-- row for the images form --}}
        <div class="row">

            <div class="col-md-3" id="create_page_ads">
                <div class="card" id="card_edit" >
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
    
            <div class="col-md-9" id="show_images">
                <div class="container">
                    <div class="row d-flex justify-content-center" id="image_styling">
                        <div class="col-md-6">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div id="box_edit">
                                            <img class="d-block w-100" src="/gallery/{{$product->thumbnail}}" alt="First slide">
                                        </div>    
                                    </div>
                                    <p hidden>{{$images = DB::table('photos')->where('product_id',$product->id)->get()}}
                                        <p>
                                            @foreach ( $images as $image)
                                            <div class="carousel-item">
                                                <div id="box_edit">    
                                                    <img class="d-block w-100" src="/gallery/{{$image->path}}" alt="other slide">
                                                </div>
                                                <div class="carousel-caption d-none d-md-block">
                                                    <form action="{{ route('photos.destroy', $image->id) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        {{-- <button type="submit" class="btn btn-danger">remove</button> --}}
                                                        <button type="submit"  title="Remove Item" class="btn btn-outline-danger btn-xs">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            @endforeach
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true" id="cursor"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true" id="cursor"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    {{-- row for the image replacement fields --}}
    <div class="row">

        <div class="col-md-3">
            {{-- extra for the styling only --}}
        </div>

        <div class="col-md-9" id="edit_images">
            <div class="container">
                <div class="row d-flex justify-content-center" >
                    <div class="col-md-11">
                    <form action="{{ route('photos.store', $product->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                        @csrf
                        <input class="input" type="text" name="productId" id="productId" value="{{$product->id}}" hidden>
                        {{-- Add & Update Gallery --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="label" for="imagecollection"> Replace Product Thumbnail </label>
                                <input type="file" class="form-control" name="thumbnail" >
                            </div>

                            <div class="form-group col-md-6">
                                <label class="label" for="imagecollection"> Replace Product Images </label>
                                <input type="file" class="form-control" name="images[]" multiple >
                            </div>
                        </div>
                        {{-- <div class="field is-grouped"> --}}
                            {{-- <div class="control"> --}}
                                <button class="button is-link" type="submit">Click to Update</button>
                            {{-- </div> --}}
                        {{-- </div>  --}}
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>

    {{-- row for replacing additional fields --}}
    <div class="row">
        <div class="col-md-3" id="create_page_ads">
            <div class="card" id="card_edit" >
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

        <div class="col-md-9">
            <div class="container">
                <div class="row d-flex justify-content-center" >
                    <div class="col-md-12" id="create_page">
                        <form method="POST" action="/products/{{$product->id}}">
                            @csrf
                            @method('PUT')

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title" class="label">Book Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{$product->title}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="author" class="label">Book Author</label>
                                    <input type="text" class="form-control" name="author" id="author" value="{{$product->author}}">
                                </div>

                            </div>

                                <div class="form-group">
                                    <label for="description" class="label">Description</label>
                                    <textarea class="form-control" name="description" id="description" >{{$product->description}}</textarea>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="publisher" class="label">Book Publisher</label>
                                        <input type="text" class="form-control" name="publisher" id="publisher" value="{{$product->book_publisher}}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="ISBN_NO" class="label">International Standard Book Number</label>
                                        <input type="text" class="form-control" name="ISBN_NO" id="ISBN_NO" value="{{$product->ISBN_NO}}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="weight" class="label">Weight of Book</label>
                                        <input class="form-control"  type="number" name="weight" id="weight" value="{{$product->weight}}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pages" class="label">Pages</label>
                                        <input class="form-control" type="number" name="pages" id="pages" value="{{$product->pages}}">
                                    </div>


                                    <div class="form-group col-md-4">
                                        <label for="quantity" class="label">Quantity</label>
                                        <input class="form-control" type="number" name="quantity" id="quantity"  value="{{$product->quantity}}">
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="price" class="label">Price</label>
                                        <input  class="form-control" type="number" name="price" id="price" value="{{$product->price}}">
                                    </div>
                                </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="published_date" class="label">Date Published</label>
                                    <input  class="form-control" type="date" name= "published_date" value="{{$product->published_date}}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="condition" class="label">Condition</label>
                                    {{-- select allows me to create a dropdown --}}
                                    {{-- option allows --}}
                                    <select name="conditionselect" id="condition" class="form-control input-lg dynamic" data-dependent="labSubCat">
                                        <option value="{{$conditionname}}">{{$conditionname}}</option>
                                        @foreach($conditions as $co)
                                            <option value="{{$co->name}}">{{$co->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <div id="radio_styling">
                                    <label class="categories" class="label">Select Category</label><br>
                                    @foreach ($categories as $cats)
                                    <div class="form-check">
                                        <input type="checkbox" name="categories1[]" value="{{ $cats->id }}"
                                        {{-- if current user role has one of the roles in the roles table then the box should be checked --}}
                                        @if($product->categories()->pluck('category_id')->contains($cats->id)) checked @endif>
                                        <label>{{$cats->name}} </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <button  class="button is-link" type="submit" id="disable-button">Click to Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@endcan