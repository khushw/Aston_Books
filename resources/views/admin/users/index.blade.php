@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    {{-- this table came from https://getbootstrap.com/docs/4.3/content/tables/ --}}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            {{-- for each loop searchs the table and find all users and then gets their name , email and gives it edit and delete option for the admin --}}
                            @foreach ($users as $user)
                                <tr>
                                <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    {{-- get the user roles and then add it to the index page as an array as user may have more than 1 more --}}
                                    <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }} </td>
                                    <td>
                                        @can('edit-users')
                                        {{-- adding the routes for the 2 buttons, also passing the parameter in the route as we need to tell which user will be ediited or deleted --}}
                                        <a href="{{route ("admin.users.edit",$user->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a> 
                                        @endcan
                                        @can('delete-users')
                                        <form action="{{ route("admin.users.destroy",$user)}}" method="POST" class="float-left">
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
