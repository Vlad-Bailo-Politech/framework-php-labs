<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Список авторів
    public function index()
    {
        $authors = Author::with('books')->get();
        //return response()->json($authors);
        return view('authors.index', compact('authors'));
    }

    // Форма створення (не обов’язково якщо API, але можна)
    public function create()
    {
        //return response()->json(['message' => 'Повернути форму створення (якщо blade) або просто залишити порожньо']);
        return view('authors.create');
    }

    // Збереження нового автора
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::create($request->only('name'));
        return response()->json(['message' => 'Автора створено', 'author' => $author], 201);
        //return redirect()->route('authors.index')->with('success', 'Автора створено');
    }

    // Перегляд автора
    public function show($id)
    {
        $author = Author::with('books')->findOrFail($id);
        return response()->json($author);
        //return view('authors.show', compact('author'));
    }

    // Форма редагування
    public function edit($id)
    {
        $author = Author::findOrFail($id);
        //return response()->json($author);
        return view('authors.edit', compact('author'));
    }

    // Оновлення автора
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::findOrFail($id);
        $author->update($request->only('name'));

        return response()->json(['message' => 'Автора оновлено', 'author' => $author]);
        //return redirect()->route('authors.show', $author->id)->with('success', 'Автора оновлено');
    }

    // Видалення автора
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json(['message' => 'Автора видалено']);
        //return redirect()->route('authors.index')->with('success', 'Автора видалено');
    }
}
