
@extends('layouts.master')
@section('title', 'Bill')
@section('content')

<div class="container mt-3">
  <h2>Bill</h2>
              
  <table class="table table-borderless">
    <thead>
      <tr>
        <th>Quantity</th>
        <th>Name</th>
        <th>Price</th>
        <th>Unit</th>
      </tr>
    </thead>
    <tbody>
      
    <tbody>
    @php $total = 0; @endphp
    @foreach ($bill->products as $product)
        @php $total += $product->quantity * $product->price; @endphp
        <tr>
            <td>{{$product->quantity}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->unit}}</td>
        </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th colspan="2">Total</th>
        <th colspan="2">{{ $total }}</th>
    </tr>
</tfoot>

@endsection