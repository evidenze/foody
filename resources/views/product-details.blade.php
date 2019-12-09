@extends('layouts.admin')

@section('content')
@if(session()->has('verified'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('verified') }}
    </div>
@endif

<div class="container mt-5">
    <h4>Product Details</h4><br>
    <div class="card p-5 shadow-sm">
   <div class="row mb-5">
       <div class="col-md-2 mb-3">
           <p class="text-secondary">Product:</p>
           <p class="font-weight-bold">{{ $product->name }}</p>
       </div>
       <div class="col-md-2 mb-3">
           <p class="text-secondary">Quantity:</p>
           <p class="font-weight-bold">{{ $product->quantity }}</p>
       </div>
       <div class="col-md-2 mb-3">
           <p class="text-secondary">Product Description:</p>
           <p>{{ $product->description }}</p>
       </div>
       <div class="col-md-2 mb-3">
           <p class="text-secondary">Prize:</p>
           <p class="font-weight-bold">NGN {{ number_format($product->amount) }}</p>
       </div>
       <div class="col-md-4 mb-3">
           <p class="text-secondary">Verification Status:</p>
           <p class="font-weight-bold">{{ $product->is_verified == true ? 'Verified' : 'Pending verification' }}</p>
       </div>
   </div>



   @if($product->is_verified == false)
   <form method="POST" action="{{ route('confirmDelivery') }}" >
                @csrf
                @method('PUT')

                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <p><button type="submit" class="btn cart">
                        Verify Product
                    </button></p>
    </form>
    @else
    <p><a class="btn cart disabled" href="#">Product verified</a></p>
   @endif
</div>
</div>
@endsection
