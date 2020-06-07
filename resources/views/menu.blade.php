@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card-deck mb-3 text-center">

      <div class="card mb-4 shadow-sm">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">Product Management</h4>
        </div>
        <div class="card-body">
            <br>
          <ul class="list-unstyled mt-2 mb-3">
            <li>Edit Product Information</li>
            <li>Delete Products</li>
          </ul>
          <br><br>
          <a href="{{ route('forsale.index') }}"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Product Management</button></a>
        </div>
      </div>

      <div class="card mb-4 shadow-sm">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">Sold Products</h4>
        </div>
        <div class="card-body">
            <br>
          <ul class="list-unstyled mt-2 mb-3">
            <li>View items sold</li>
            <li>Send shipping notifications</li>
          </ul>
          <br><br>
          <a href="{{ route('listings.index') }}"><button type="button" class="btn btn-lg btn-block btn-primary">Shipping</button></a>
        </div>
      </div>

      <div class="card mb-4 shadow-sm">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">Order Management</h4>
        </div>
        <div class="card-body">
            <br>
          <ul class="list-unstyled mt-2 mb-3">
            <li>View order details</li>
            <li>Recieve notifications when items are shipped!</li>
          </ul>
          <br><br>
          <a href="{{ route('orders.index') }}"><button type="button" class="btn btn-lg btn-block btn-outline-primary">My Orders</button></a>
        </div>
      </div>


    </div>
</div>

@can('manage-users')                                
<div class="container">
  <div class="card-deck mb-3 text-center">

    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Manage Users</h4>
      </div>
      <div class="card-body">
          <br>
        <ul class="list-unstyled mt-2 mb-3">
          <li>Remove/edit user information</li>
          <li>Change role permission</li>
        </ul>
        <br><br>
        <a href="{{ route('admin.users.index') }}"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Manage Users</button></a>
      </div>
    </div>

    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Categories Management</h4>
      </div>
      <div class="card-body">
          <br>
        <ul class="list-unstyled mt-2 mb-3">
          <li>Add additional categories</li>
          <li>Remove and Edit categories</li>
        </ul>
        <br><br>
        <a href="{{ route('categories.index') }}"><button type="button" class="btn btn-lg btn-block btn-primary">Categories</button></a>
      </div>
    </div>

    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Condition Management</h4>
      </div>
      <div class="card-body">
          <br>
        <ul class="list-unstyled mt-2 mb-3">
          <li>Add additional conditions</li>
          <li>Remove and Edit conditions</li>
        </ul>
        <br><br>
        <a href="{{ route('conditions.index') }}"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Manage Condition</button></a>
      </div>
    </div>

  </div>
</div>

<div class="container">
  <div class="card-deck mb-3 text-center">
    
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Featured</h4>
      </div>
      <div class="card-body">
          <br>
        <ul class="list-unstyled mt-2 mb-3">
          <li>Remove featured product</li>
          <li>Add featured product</li>
        </ul>
        <br><br>
        <a href="/featured"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Manage Featured</button></a>
      </div>
    </div>

    <div class="card mb-4 shadow-sm">
    </div>

    <div class="card mb-4 shadow-sm">
    </div>
    
  </div>
</div>
@endcan
    
@endsection


