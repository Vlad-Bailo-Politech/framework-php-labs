<?php

namespace App\Http\Controllers;

use App\Models\BookReturn;
use App\Models\Loan;
use Illuminate\Http\Request;

class BookReturnController extends Controller
{
    // Список всіх повернень
    public function index()
    {
        $returns = BookReturn::with('loan')->get();
        //return response()->json($returns);
        return view('book_returns.index', compact('returns'));
    }

    // Форма створення повернення
    public function create()
    {
        // Повертаємо лише ті позики, які ще не мають повернення
        $loans = Loan::doesntHave('bookReturn')->get();
        //return response()->json($loans);
        return view('book_returns.create', compact('loans'));
    }

    // Збереження нового повернення
    public function store(Request $request)
    {
        $request->validate([
            'loan_id' => 'required|exists:loans,id|unique:book_returns,loan_id',
            'return_date' => 'required|date|after_or_equal:' . Loan::findOrFail($request->loan_id)->loan_date,
        ]);

        $return = BookReturn::create($request->only('loan_id', 'return_date'));
        return response()->json(['message' => 'Повернення зафіксовано', 'return' => $return], 201);
        //return redirect()->route('book_returns.index')->with('success', 'Повернення книги успішно зафіксовано');
    }

    // Перегляд повернення
    public function show($id)
    {
        $return = BookReturn::with('loan')->findOrFail($id);
        return response()->json($return);
        //return view('book_returns.show', compact('return'));
    }

    // Форма редагування
    public function edit($id)
    {
        $return = BookReturn::findOrFail($id);
        //return response()->json($return);
        return view('book_returns.edit', compact('return', 'loans'));
    }

    // Оновлення повернення
    public function update(Request $request, $id)
    {
        $return = BookReturn::findOrFail($id);

        $request->validate([
            'return_date' => 'required|date|after_or_equal:' . $return->loan->loan_date,
        ]);

        $return->update(['return_date' => $request->return_date]);

        return response()->json(['message' => 'Повернення оновлено', 'return' => $return]);
        //return redirect()->route('book_returns.show', $return->id)->with('success', 'Повернення успішно оновлено');
    }

    // Видалення повернення
    public function destroy($id)
    {
        $return = BookReturn::findOrFail($id);
        $return->delete();

        return response()->json(['message' => 'Повернення видалено']);
        //return redirect()->route('book_returns.index')->with('success', 'Повернення успішно видалено');
    }
}
