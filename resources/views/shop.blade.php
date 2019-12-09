@extends('layouts.app')

@section('content')

<div class="container-fluid bg-dark text-white p-5">
    <h4 class="pl-5">{{ $vendor->name }}</h4>
</div>

<div class="container mt-5">

    <h1>Our Menu List</h1>

    @if(count($products) > 0)

    <div class="row text-center mt-5 mb-5">
        @foreach($products as $product)
        <div class="col-md-3">
            <div class="card mb-3 shadow-sm p-3">
            <img src="{{ asset('storage/'.$product->photo) }}" class="mx-auto d-block" alt="..." style="width:100%;height:200px;object-fit:contain;"><br>
            <h5 class="card-title font-weight-bold">{{ $product->name }}</h5>
            <p class="text-center text-secondary">NGN {{ number_format($product->amount) }}</p>
            <form method="POST" action="{{ route('addToCart') }}" >
                @csrf

                <input type="hidden" name="id" value="1"/>
                    <input type="hidden" name="name" value="Fried Rice">
                    <input type="hidden" name="prize" value="1200">
                    <button type="submit" class="btn cart">
                        Add to Cart
                    </button>
            </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<div class="container-fluid bg-dark pt-5 pb-5 mt-5 text-center text-white">
    <p>&copy; 2019 FoodyStack. All Right Reserved.</p>
</div>
@endsection
