@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Edit Condition</div>
    
                <div class="card-body">
                    <form action="/conditions/{{$condition->id}}" method="POST">
                         @csrf
                         {{-- use this method as most browsers only support POST so laravel provides a way around it --}}
                         {{ method_field("PUT")}}                         
                        
                         {{-- for the admin to change condition name  --}}
                                                
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="input" name="name" value="{{ $condition->name }}">
                            </div>
                        </div>

                        {{-- for the admin to change condition description  --}}
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="textarea" class="input" name="description" value="{{ $condition->description }}">
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
