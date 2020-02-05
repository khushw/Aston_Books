@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Create Condition</div>
    
                <div class="card-body">
                    <form action="/conditions/" method="POST">
                         @csrf                        
                        
                         {{-- for the admin to add condition name  --}}
                                                
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="input" name="name">
                            </div>
                        </div>

                        {{-- for the admin to add condition name  --}}
                                                
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="textarea" class="input" name="description">
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
