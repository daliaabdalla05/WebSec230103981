@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Buy Product</h2>

    <div class="card mb-3">
        <div class="card-body">
            <h4>{{ $product->name }}</h4>
            <p>{{ $product->description }}</p>
            <p><strong>Price:</strong> ${{ $product->price }}</p>
        </div>
    </div>

    @if(auth()->user()->role === 'customer')
        <div class="alert alert-info">
            Your Store Credit: <strong>${{ auth()->user()->store_credit }}</strong>
        </div>

        @if(auth()->user()->store_credit >= $product->price)
            {{-- ✅ FIX: Pass product ID to route --}}
            <form method="POST" action="{{ route('products.purchase', ['id' => $product->id]) }}">
                @csrf
                <button type="submit" class="btn btn-success">Buy with Store Credit</button>
            </form>
        @else
            <div class="alert alert-warning">
                Not enough store credit.
            </div>
        @endif
    @endif
</div>
@endsection
