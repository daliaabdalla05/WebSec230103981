@extends('layouts.master')
@section('title', isset($policy) ? 'Edit Refund Policy' : 'Create Refund Policy')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ isset($policy) ? 'Edit Refund Policy' : 'Create New Refund Policy' }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ isset($policy) ? route('refund-policies.update', $policy) : route('refund-policies.store') }}" method="POST">
                        @csrf
                        @if(isset($policy))
                            @method('PUT')
                        @endif

                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $policy->title ?? '') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="content">Policy Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content', $policy->content ?? '') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $policy->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active Policy</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="effective_from">Effective From</label>
                                    <input type="datetime-local" class="form-control @error('effective_from') is-invalid @enderror" id="effective_from" name="effective_from" value="{{ old('effective_from', isset($policy->effective_from) ? $policy->effective_from->format('Y-m-d\TH:i') : '') }}">
                                    @error('effective_from')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="effective_until">Effective Until</label>
                                    <input type="datetime-local" class="form-control @error('effective_until') is-invalid @enderror" id="effective_until" name="effective_until" value="{{ old('effective_until', isset($policy->effective_until) ? $policy->effective_until->format('Y-m-d\TH:i') : '') }}">
                                    @error('effective_until')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($policy) ? 'Update Policy' : 'Create Policy' }}
                            </button>
                            <a href="{{ route('refund-policies.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 