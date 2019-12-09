@extends('layouts.admin')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h4 class="font-weight-bold">Admin Dashboard</h4>

            <div class="row mt-5">
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm p-3">
                        <p class="font-weight-bold">Total Vendors</p>
                        <h4>{{ count($vendors) }}</h4>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm p-3">
                        <p class="font-weight-bold">Pending Orders</p>
                        <h4>{{ count($pending) }}</h4>
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
                        <p class="font-weight-bold">Delivered Orders</p>
                        <h4>{{ count($delivered) }}</h4>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm mt-5 mb-5">
                <div class="card-header">Vendors List</div>

                <div class="card-body">
                   @if (count($vendors) == 0)
                    <h4 class="text-center">No vendor available.</h4><br>

                    @else
                    <div class="table-responsive">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</td>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-secondary">
                            @foreach($vendors as $vendor)
                            <tr>
                            <td>{{ $vendor->name }}</td>
                            <td>{{ $vendor->phone }}</td>
                            <td>{{ $vendor->email }}</td>
                            <td>{{ $vendor->is_active == true ? 'Verified' : 'Pending verification' }}</td>                            
                            <td><a class="btn cart" href="{{ route('vendorDetails', $vendor->id) }}">View Details</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm mt-5 mb-5">
                <div class="card-header">Products List</div>

                <div class="card-body">
                   @if (count($products) == 0)
                    <h4 class="text-center">No product available.</h4><br>

                    @else
                    <div class="table-responsive">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Prize</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-secondary">
                            @foreach($products as $product)
                            <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->amount }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->is_verified == true ? 'Verified' : 'Pending verification' }}</td>
                            <td><a class="btn cart" href="{{ route('productDetails', $product->id) }}">View Product</a></td>
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
