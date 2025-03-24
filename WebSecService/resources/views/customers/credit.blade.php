@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Add Store Credit to Customer</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">{{ $customer->name }}</h4>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Current Store Credit:</strong> ${{ $customer->store_credit }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('customers.credit.update', $customer->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="credit">Add Credit Amount ($):</label>
            <input type="number" name="credit" id="credit" step="0.01" min="0" class="form-control @error('credit') is-invalid @enderror" required>
            
            @error('credit')
                <div class="invalid-feedback">{{ $message }}</
