<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Вивід списку книг
    public function index()
    {
        $books = Book::with('author')->get();
        //return response()->json($books);
        return view('books.index', compact('books'));
    }

    // Показ форми для створення (якщо робите через blade — return view())
    public function create()
    {
        $authors = Author::all();
        //return response()->json($authors);
        return view('books.create', compact('authors'));
    }

    // Збереження нової книги
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book = Book::create($request->only('title', 'author_id'));
        //return response()->json(['message' => 'Книгу створено', 'book' => $book], 201);
        return redirect()->route('books.index')->with('success', 'Книгу створено');
    }

    // Показ однієї книги
    public function show($id)
    {
        $book = Book::with('author')->findOrFail($id);
        return response()->json($book);
        //return view('books.show', compact('book'));
    }

    // Показ форми редагування (аналог create)
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        //return response()->json(['book' => $book, 'authors' => $authors]);
        return view('books.edit', compact('book', 'authors'));
    }

    // Оновлення книги
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->only('title', 'author_id'));

        return response()->json(['message' => 'Книгу оновлено', 'book' => $book]);
        //return redirect()->route('books.show', $book->id)->with('success', 'Книгу оновлено');
    }

    // Видалення книги
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['message' => 'Книгу видалено']);
        //return redirect()->route('books.index')->with('success', 'Книгу видалено');
    }
}
