<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->orderBy('surname')->paginate(30);

        return view('admin.authors.index', compact('authors'));
    }

    public function show($id)
    {
        $author = Author::with('books')->where('id', $id)->first();

        return view('admin.authors.detail', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $author->update($this->validateInput($request));

        return redirect('/admin/authors')->with('status', 'Success')->with('message', 'Author ' . $author->name . ' ' . $author->surname . ' has been updated');
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        Author::create($this->validateInput($request));

        return redirect('/admin/authors')->with('status', 'Success')->with('message', 'Author ' . $request->name . ' ' . $request->surname . ' has been added');
    }

    public function destroy($id)
    {
        Author::where('id', $id)->delete();

        return redirect('/admin/authors')->with('status', 'Success')->with('message', 'Author has been deleted');
    }

    private function validateInput($input) 
    {
        return $input->validate([
            'name' => ['required', 'min:2', 'max:100'],
            'surname' => ['required', 'min:2', 'max:100'],
            'nationality' => 'nullable',
            'birthdate' => ['nullable', 'date']
        ]);
    }
}
