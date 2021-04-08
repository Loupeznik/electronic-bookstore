<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    /**
     * Render the frontpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function author($id)
    {
        $author = Author::with('books')->where('id', $id)->first();

        return view('frontend.authors.detail', compact($author));
    }

    public function booksFeature()
    {
        $books = Book::with(['author', 'category'])->latest('created_at')->take(6)->get();

        return view('home', compact('books'));
    }

    public function booksPage(Request $request)
    {
        if (! $request->book)
        {
            $books = Book::with(['author', 'category'])->latest('created_at')->paginate(18);
        }
        else 
        {
            $books = Book::with(['author', 'category'])->where('name', 'like', '%' . $request->book . '%')->orWhere('isbn', $request->book)->paginate(18);
        }
        
        $categories = Category::all();

        return view('books', compact(['books', 'categories']));
    }

}
