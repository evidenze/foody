@extends('layouts.admin')

@section('content')
@if(session()->has('vendor'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('vendor') }}
    </div>
@endif

<div class="container mt-5 mb-5">
    <h4>Vendor Details</h4><br>
    <div class="card p-5 shadow-sm">
   <div class="row mb-5">
       <div class="col-md-2 mb-3">
           <p class="text-secondary">Name</p>
           <p class="font-weight-bold">{{ $vendor->name }}</p>
       </div>
       <div class="col-md-2 mb-3">
           <p class="text-secondary">Phone</p>
           <p class="font-weight-bold">{{ $vendor->phone }}</p>
       </div>
       <div class="col-md-4 mb-3">
           <p class="text-secondary">Email</p>
           <p>{{ $vendor->email }}</p>
       </div>
       <div class="col-md-4 mb-3">
           <p class="text-secondary">Verification Status:</p>
           <p class="font-weight-bold">{{ $vendor->is_active == true ? 'Verified' : 'Pending verification' }}</p>
       </div>
   </div>



   @if($vendor->is_active == false)
   <form method="POST" action="{{ route('confirmVendor') }}" >
                @csrf
                @method('PUT')

                    <input type="hidden" name="id" value="{{ $vendor->id }}">
                    <p><button type="submit" class="btn cart">
                        Verify Product
                    </button></p>
    </form>
    @else
    <p><a class="btn cart disabled" href="#">Vendor verified</a></p>
   @endif
</div>
</div>
@endsection
