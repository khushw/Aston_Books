@extends('layouts.app')

@section('content')
    
    {{-- <example-component> </example-component> --}}

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">E Chat System</div>
                    <div class="card-body">
                        <chat-app :user="{{ auth()->user() }}"> </chat-app>
                    </div>
            </div>
        </div>
    </div>
    
@endsection