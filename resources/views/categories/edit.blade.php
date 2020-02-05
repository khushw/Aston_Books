@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Edit Category</div>
    
                <div class="card-body">
                    <form action="/categories/{{$categories->id}}" method="POST">
                         @csrf
                         {{-- use this method as most browsers only support POST so laravel provides a way around it --}}
                         {{ method_field("PUT")}}                         
                        
                         {{-- for the admin to change category name  --}}
                                                
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="input" name="name" value="{{ $categories->name }}">

                                {{-- @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
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
