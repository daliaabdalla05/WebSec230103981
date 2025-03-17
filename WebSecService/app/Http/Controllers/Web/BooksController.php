<?php
namespace App\Http\Controllers\Web;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use DB;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BooksController extends Controller {

	use ValidatesRequests;

	public function __construct()
    {
        $this->middleware('auth:web')->except('list');
    }

	public function list(Request $request) {

		$query = book::select("books.*");

		$query->when($request->keywords, 
		fn($q)=> $q->where("name", "like", "%$request->keywords%"));

		$query->when($request->min_price, 
		fn($q)=> $q->where("price", ">=", $request->min_price));
		
		$query->when($request->max_price, fn($q)=> 
		$q->where("price", "<=", $request->max_price));
		
		$query->when($request->order_by, 
		fn($q)=> $q->orderBy($request->order_by, $request->order_direction??"ASC"));

		$books = $query->get();

		return view('books.list', compact('books'));
	}

	public function edit(Request $request, book $book = null) {


		$book = $book??new book();

		return view('books.edit', compact('book'));
	}

	public function save(Request $request, book $book = null) {

	
	
		$this->validate($request, [
			'author' => ['required', 'string', 'max:32'],
			'name' => ['required', 'string', 'max:128'],
			'published_year' => ['required', 'numeric'],
			'description' => ['required', 'string', 'max:1024'],
			'price' => ['required', 'numeric'],
		]);
	
		$book = $book ?? new book();
		$book->fill($request->all());
		$book->save();
	
		return redirect()->route('books_list');
	}
	

	public function delete(Request $request, book $book) {



		$book->delete();

		return redirect()->route('books_list');
	}
} 