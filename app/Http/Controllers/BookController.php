<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Resources\BookResources;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return BookResources::collection(Book::with('author')->get());
    }

    public function show(Book $book): BookResources
    {
        $book->load('author');
        return new BookResources($book);
    }

    public function store(BookStoreRequest $request): JsonResponse
    {
        $book = new Book();
        $book->title = $request->input('title');
        $book->publication_date = $request->input('publication_date');
        $book->price = $request->input('price');
        $book->description = $request->input('description');
        $book->author_id = $request->input('author_id');
        $book->save();
        $book->load('author');
        return new JsonResponse([
            'data' => new BookResources($book),
            'message' => "Success!"
        ]);
    }

    public function update(BookStoreRequest $request, Book $book): JsonResponse
    {
        $book->title = $request->input('title');
        $book->publication_date = $request->input('publication_date');
        $book->price = $request->input('price');
        $book->description = $request->input('description');
        $book->author_id = $request->input('author_id');
        $book->save();
        $book->load('author');
        return new JsonResponse([
            'data' => new BookResources($book),
            'message' => "Success!"
        ]);
    }

    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return new JsonResponse([
            'data' => [],
            'message' => "Success!"
        ]);
    }
}
