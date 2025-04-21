@extends('layouts.master')
@section('title', 'Refund Policies')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Refund Policies</h4>
                    @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Employee'))
                        <a href="{{ route('refund-policies.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create New Policy
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @forelse($policies as $policy)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $policy->title }}</h5>
                                <p class="card-text">{{ Str::limit($policy->content, 200) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        Effective: {{ $policy->effective_from ? $policy->effective_from->format('M d, Y') : 'Immediately' }}
                                        @if($policy->effective_until)
                                            - {{ $policy->effective_until->format('M d, Y') }}
                                        @endif
                                    </small>
                                    <div>
                                        <a href="{{ route('refund-policies.show', $policy) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                        @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Employee'))
                                            <a href="{{ route('refund-policies.edit', $policy) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('refund-policies.destroy', $policy) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this policy?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">
                            No refund policies found.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 