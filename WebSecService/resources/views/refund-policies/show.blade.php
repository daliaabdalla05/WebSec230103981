@extends('layouts.master')
@section('title', $policy->title)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ $policy->title }}</h4>
                    @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Employee'))
                        <div>
                            <a href="{{ route('refund-policies.edit', $policy) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('refund-policies.destroy', $policy) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this policy?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Policy Status</h5>
                        <p>
                            @if($policy->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-4">
                        <h5>Effective Period</h5>
                        <p>
                            From: {{ $policy->effective_from ? $policy->effective_from->format('F j, Y g:i A') : 'Immediately' }}<br>
                            @if($policy->effective_until)
                                Until: {{ $policy->effective_until->format('F j, Y g:i A') }}
                            @else
                                Until: No end date specified
                            @endif
                        </p>
                    </div>

                    <div class="mb-4">
                        <h5>Policy Content</h5>
                        <div class="policy-content">
                            {!! nl2br(e($policy->content)) !!}
                        </div>
                    </div>

                    <div class="text-muted">
                        <small>
                            Last updated: {{ $policy->updated_at->format('F j, Y g:i A') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 