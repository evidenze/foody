@extends('layouts.vendor')

@section('content')
@if(session()->has('added'))
    <div class="alert text-center alert-success" role="alert">
        {{ session('added') }}
    </div>
@endif
@if(session()->has('edited'))
    <div class="alert text-center alert-success" role="alert">
        {{ session('edited') }}
    </div>
@endif
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h4 class="font-weight-bold">Vendor Dashboard</h4>

            <div class="row mt-5">
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm p-3">
                        <p class="font-weight-bold">Total Products</p>
                        <h4>{{ count($products) }}</h4>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm p-3">
                        <p class="font-weight-bold">Total Earnings</p>
                        <h4>NGN {{ number_format($earning) }}</h4>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm p-3">
                        <p class="font-weight-bold">Total Orders</p>
                        <h4>{{ count($delivered) }}</h4>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm p-3">
                        <p class="font-weight-bold">Pending Orders</p>
                        <h4>{{ count($pending) }}</h4>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm mt-5 mb-5">
                <div class="card-header">Menu List <a class="btn float-right cart" href="{{ route('addProduct') }}">Add Product</a></div>

                <div class="card-body">
                   @if (count($products) == 0)
                    <h4 class="text-center">No order made.</h4><br>
                    <p class="text-center"><a class="btn cart" href="{{ route('addProduct') }}">Go to Shop</a></p>

                    @else
                    <div class="table-responsive">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Prize</th>
                            <th scope="col">Action</th>                            
                            </tr>
                        </thead>
                        <tbody class="text-secondary">
                            @foreach($products as $item)
                            <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>NGN {{ number_format($item->amount) }}</td>
                            <td><a class="btn cart" href="{{ route('editProduct', $item->id) }}">View Details</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
