{{-- @extends('layouts.app')

@section('content')

<h1>Categories</h1>

{{-- display all the categories in the database --}}
{{-- @if(count($categories)>0)
    @foreach($categories as $category)
        <div class="list-group-item">
            <h3>{{$category->name}}</h3>
        </div>
    @endforeach
    {{$categories->links()}} <!-- displays the page number links for after x number of products appear) -->
@else 
    <p>Be the first to create a category!</p>
@endif

@endsection --}} 


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Conditions</div>

                <div class="card-body">
                    {{-- this table came from https://getbootstrap.com/docs/4.3/content/tables/ --}}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col"><a href="{{route ("conditions.create") }}"><button type="button" class="btn btn-primary float-left">Add Condition</button></a></th>

                          </tr>
                        </thead>
                        <tbody>
                            {{-- for each loop searchs the table and find all users and then gets their name , email and gives it edit and delete option for the admin --}}
                            @foreach ($conditions as $condition)
                                <tr>
                                <th scope="row">{{$condition->id}}</th>
                                    <td>{{$condition->name}}</td>
                                    <td>{{$condition->description}}</td>

                                    <td>
                                        @can('edit-users')
                                        {{-- adding the routes for the 2 buttons, also passing the parameter in the route as we need to tell which user will be ediited or deleted --}}
                                        <a href="{{route ("conditions.edit",$condition->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a> 
                                        @endcan
                                        @can('delete-users')
                                        <form action="{{ route("conditions.destroy",$condition->id)}}" method="POST" class="float-left">
                                            @csrf
                                            {{ method_field('DELETE') }} 
                                            <button type="submit" class="btn btn-warning">Delete</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>  
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
