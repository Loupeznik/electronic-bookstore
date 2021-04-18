<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use Tests\TestCase;

class BookModelTest extends TestCase
{
    use RefreshDatabase;

    protected $testAuthorSurname = 'Hemmingway';
    protected $testCategoryName = 'Fiction';
    protected $testBookISBN = '978-80-207-1682-8';

    /**
     * Create Author and Category to associate with the tested book.
     *
     * @return void
     */
    public function test_helper_creation()
    {

        $author = [
            'name' => 'Ernest',
            'surname' => 'Hemmingway',
            'nationality' => 'American'
        ];

        $category = [
            'name' => $this->testCategoryName
        ];

        Author::create($author);

        Category::create($category);

        $this->assertDatabaseHas('authors', $author);
        $this->assertDatabaseHas('categories', $category);

    }

    /**
     * Create the book for testing purposes.
     *
     * @return void
     */
    public function test_book_creation()
    {

        $author = [
            'name' => 'Ernest',
            'surname' => 'Hemmingway',
            'nationality' => 'American'
        ];

        $category = [
            'name' => $this->testCategoryName
        ];

        Author::create($author);

        Category::create($category);

        $book = [
            'name' => 'For whom the bell tolls',
            'author_id' => Author::where('surname', $this->testAuthorSurname)->first()->id,
            'price' => '263.99',
            'isbn' => '978-80-207-1682-8',
            'language' => 'en',
            'category_id' => Category::where('name', $this->testCategoryName)->first()->id,
            'available' => 100,
            'description' => 'Lorem ipsum bla bla bla',
            'year' => '1932'
        ];

        Book::create($book);

        $this->assertDatabaseHas('books', $book);

        $response = Book::where('isbn', $this->testBookISBN)->first()->author->surname;

        $this->assertEquals($this->testAuthorSurname, $response);

        $response = Author::where('surname', $this->testAuthorSurname)->first()->books->where('isbn', $this->testBookISBN)->first()->isbn;

        $this->assertEquals($this->testBookISBN, $response);

        $response = Book::where('isbn', $this->testBookISBN)->first()->category->name;

        $this->assertEquals($this->testCategoryName, $response);

        $response = Category::withCount('books')->where('name', $this->testCategoryName)->first()->count();

        $this->assertGreaterThanOrEqual(1, $response);

    }
}
