<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Book::all(), 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:255',
            'isbn'           => 'required|string|unique:books,isbn',
            'published_year' => 'required|integer|min:1000|max:9999',
            'is_available'   => 'required|boolean',
        ]);

        $book = Book::create($validated);
        return response()->json($book, 201);
    }

    public function show(string $id): JsonResponse
    {
        $book = Book::findOrFail($id);
        return response()->json($book, 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title'          => 'sometimes|string|max:255',
            'author'         => 'sometimes|string|max:255',
            'isbn'           => 'sometimes|string|unique:books,isbn,' . $id,
            'published_year' => 'sometimes|integer|min:1000|max:9999',
            'is_available'   => 'sometimes|boolean',
        ]);

        $book->update($validated);
        return response()->json($book, 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully.'], 200);
    }
}
