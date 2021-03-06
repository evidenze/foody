@extends('layouts.vendor')

@section('content')

@if(session()->has('added'))
    <div class="alert text-center alert-success" role="alert">
        {{ session('edited') }}
    </div>
@endif

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4>Edit Product</h4><br>
                    <form enctype="multipart/form-data" method="POST" action="{{ route('updateProduct', $product->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">

                            <div class="col-md-12">
                                <label>Name</label>
                                <input placeholder="Name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <label>Prize</label>
                                <input placeholder="Prize" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ $product->amount }}" required autocomplete="amount">

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <label>Quantity</label>
                                <input placeholder="Quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $product->quantity }}" required autocomplete="quantity">

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <label>Description</label>
                                <textarea rows="5" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $product->description }}" required>{{ $product->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
