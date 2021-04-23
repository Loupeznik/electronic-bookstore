<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use App\Rules\Isbn;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'category'])->orderBy('name')->get();

        return view('admin.books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with(['author', 'category'])->where('id', $id)->first();

        return view('admin.books.detail', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('admin.books.edit', compact(['book', 'authors', 'categories']));
    }

    public function update(Request $request, Book $book)
    {
        $book->update($this->validateInput($request));

        if ($request->file('photo'))
        {
            $this->uploadPhoto($request->file('photo'), $book);
        }

        return redirect('/admin/books')->with('status', 'Success')->with('message', 'Book ' . $book->name . ' has been updated');
    }

    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('admin.books.create', compact(['authors', 'categories']));
    }

    public function store(Request $request)
    {
        $book = Book::create($this->validateInput($request));

        if ($request->file('photo'))
        {
            $this->uploadPhoto($request->file('photo'), $book);
        }

        return redirect('/admin/books')->with('status', 'Success')->with('message', 'Book ' . $request->name . ' has been created');
    }

    public function destroy($id)
    {
        Book::where('id', $id)->delete();

        return redirect('/admin/books')->with('status', 'Success')->with('message', 'Book has been deleted');
    }

    private function validateInput($input) 
    {
        return $input->validate([
            'name' => ['required', 'min:5', 'max:100'],
            'author_id' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'sale_price' => ['nullable', 'numeric'],
            'isbn' => ['required', new Isbn, Rule::unique('books')->ignore($input->id)],
            'language' => ['required', 'size:2'],
            'category_id' => ['required', 'integer'],
            'publisher' => 'nullable',
            'available' => ['required', 'integer'],
            'description' => ['required', 'string', 'min:20', 'max:500'],
            'year' => ['nullable', 'integer'],
            'photo' => ['nullable', 'mimes:png,jpg,webp', 'max:2048']
        ]);
    }

    // Upload book's cover photo
    private function uploadPhoto($photo, $book)
    {
        try 
        {
            $path = $photo->store('public/covers');
            $book->update([
                'photo_path' => 'covers/' . basename($path)
            ]);
        } 
        catch (Exception $e)
        {
            return redirect('/admin/books')
                ->with('status', 'Warning')
                ->with('message', 'Book saved but cover photo upload failed (Exception ' . $e->getMessage() . ')');
        }
    }
}
