@extends('layouts.master')
@section('title', 'Comments')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Add a Comment</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="3" required></textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Comments</h4>
                </div>
                <div class="card-body">
                    @foreach($comments as $comment)
                        <div class="card mb-3">
                            <div class="card-body">
                                <p class="card-text">{{ $comment->content }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        By: {{ $comment->user->name }}
                                        @if($comment->is_approved)
                                            | Approved by: {{ $comment->approver->name }}
                                            | {{ $comment->approved_at->diffForHumans() }}
                                        @endif
                                    </small>
                                    @if((auth()->user()->hasRole('Employee') || auth()->user()->hasRole('Admin')) && !$comment->is_approved)
                                        <div>
                                            <form action="{{ route('comments.approve', $comment) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 