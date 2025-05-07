<?php

namespace App\Http\Controllers;

use App\Models\Reader;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    // Список всіх читачів
    public function index(Request $request)
    {
        $query = Reader::query();

        // Фільтрація по імені
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Фільтрація по email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Кількість елементів на сторінці
        $itemsPerPage = $request->input('itemsPerPage', 10);
        $readers = $query->paginate($itemsPerPage)->withQueryString();

        return view('readers.index', compact('readers'));
    }

    // Форма створення (не обов’язкова в API)
    public function create()
    {
        //return response()->json(['message' => 'Форма створення читача (опціонально)']);
        return view('readers.create');
    }

    // Збереження нового читача
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:readers,email',
        ]);

        $reader = Reader::create($request->only('name', 'email'));

        //return response()->json(['message' => 'Читача створено', 'reader' => $reader], 201);
        return redirect()->route('readers.index')->with('success', 'Читача успішно створено');
    }

    // Перегляд конкретного читача
    public function show($id)
    {
        $reader = Reader::with('loans')->findOrFail($id);
        return response()->json($reader);
        //return view('readers.show', compact('reader'));
    }

    // Форма редагування
    public function edit($id)
    {
        $reader = Reader::findOrFail($id);
        //return response()->json($reader);
        return view('readers.edit', compact('reader'));
    }

    // Оновлення читача
    public function update(Request $request, $id)
    {
        $reader = Reader::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:readers,email,' . $reader->id,
        ]);

        $reader->update($request->only('name', 'email'));

        return response()->json(['message' => 'Читача оновлено', 'reader' => $reader]);
        //return redirect()->route('readers.show', $reader->id)->with('success', 'Читача успішно оновлено');
    }

    // Видалення читача
    public function destroy($id)
    {
        $reader = Reader::findOrFail($id);
        $reader->delete();

        return response()->json(['message' => 'Читача видалено']);
        //return redirect()->route('readers.index')->with('success', 'Читача успішно видалено');
    }
}