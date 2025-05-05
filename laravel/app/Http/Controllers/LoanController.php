<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Reader;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Список всіх позик
    public function index()
    {
        $loans = Loan::with(['book', 'reader', 'bookReturn'])->get();
        //return response()->json($loans);
        return view('loans.index', compact('loans'));
    }

    // Форма створення (або повертає список книг та читачів для заповнення)
    public function create()
    {
        $books = Book::all();
        $readers = Reader::all();

        //return response()->json(['books' => $books, 'readers' => $readers,]);
        return view('loans.create', compact('books', 'readers'));
    }

    // Збереження нової позики
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'reader_id' => 'required|exists:readers,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
        ]);

        $loan = Loan::create($request->only('book_id', 'reader_id', 'loan_date', 'due_date'));

        return response()->json(['message' => 'Позику створено', 'loan' => $loan], 201);
        //return redirect()->route('loans.index')->with('success', 'Позика успішно створена');
    }

    // Перегляд однієї позики
    public function show($id)
    {
        $loan = Loan::with(['book', 'reader', 'bookReturn'])->findOrFail($id);
        return response()->json($loan);
        //return view('loans.show', compact('loan'));
    }

    // Форма редагування
    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        $books = Book::all();
        $readers = Reader::all();

        // return response()->json([
        //     'loan' => $loan,
        //     'books' => $books,
        //     'readers' => $readers,
        // ]);
        return view('loans.edit', compact('loan', 'books', 'readers'));
    }

    // Оновлення позики
    public function update(Request $request, $id)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'reader_id' => 'required|exists:readers,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
        ]);

        $loan = Loan::findOrFail($id);
        $loan->update($request->only('book_id', 'reader_id', 'loan_date', 'due_date'));

        return response()->json(['message' => 'Позику оновлено', 'loan' => $loan]);
        //return redirect()->route('loans.show', $loan->id)->with('success', 'Позика успішно оновлена');
    }

    // Видалення позики
    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();

        return response()->json(['message' => 'Позику видалено']);
        //return redirect()->route('loans.index')->with('success', 'Позика успішно видалена');
    }
}