@if(count($errors) >0)
    @foreach($errors->all() as $error)
        <div class='alert alert-danger'>
            {{$error}}
        </div>
    @endforeach
@endif

<!--check for session success and then also display the following message single message so no loop required-->
{{-- once the user has succefully listed a product then it will show that your product has been listed --}}
@if(session('success'))
    <div class='alert alert-success'>
        {{session('success')}}
    </div>
@endif


<!--//check for session error and then also display the following message-->
@if(session('error'))
    <div class='alert alert-danger'>
        {{session('error')}}
    </div>
@endif