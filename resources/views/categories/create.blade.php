@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Create Category</div>
    
                <div class="card-body">
                    <form action="/categories/" method="POST">
                         @csrf                        
                        
                         {{-- for the admin to add category name  --}}
                                                
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="input" name="name">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Add
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
