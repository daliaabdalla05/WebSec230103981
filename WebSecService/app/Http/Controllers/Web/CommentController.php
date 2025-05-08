<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'approver'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('comments.index', compact('comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:3|max:1000',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comment submitted successfully. It will be visible after approval.');
    }

    public function approve(Comment $comment)
    {
        abort_unless(Auth::user()->hasRole('Employee') || Auth::user()->hasRole('Admin'), 403);

        $comment->update([
            'is_approved' => true,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Comment approved successfully.');
    }

    public function destroy(Comment $comment)
    {
        abort_unless(Auth::user()->hasRole('Employee') || Auth::user()->hasRole('Admin'), 403);

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}