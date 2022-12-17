@extends('products.layout')
 
@section('content')
<div class="row">
   <div class="col-lg-12 margin-tb">
      <div class="pull-left">
         <h2>Laravel 9 CRUD Operations</h2>
      </div>
      <div class="pull-right">
         <a class="btn btn-success" href="{{ route('products.create') }}">Create New Product</a>
      </div>
   </div>
</div>
 
@if ($message = Session::get('success'))
<div class="alert alert-success">
   <p>{{ $message }}</p>
</div>
@endif
 
<table class="table table-bordered">
    <thead>
       <tr>
          <th>No.</th>
          <th>Name</th>
          <th>Price</th>
          <th>Description</th>
          <th>Author</th>
          <th>Provider</th>
          <th>Created at</th>
          <th width="280px">Action</th>
       </tr>
    </thead>
    
   <tbody>
       @foreach ($products as $product)
           <tr>
              <td>{{ ++$i }}</td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->price }}</td>
              <td>{{ $product->description }}</td>
              <td>{{ $product->user->name }}</td>
              <td>{{ $product->provider ? $product->provider->description : '' }}</td>
              <td>{{ $product->updated_at->format('d/m/Y') }}</td>
              <td>
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
           </tr>
       @endforeach
    </tbody>
</table>


<div class="mx-auto pt-2">
 {{ $products->links() }}

</div>
     
@endsection
