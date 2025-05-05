@extends('layouts.app')
@section('content')
    <h1>Повернути книгу</h1>
    <form method="POST" action="{{ route('book_returns.store') }}">
        @csrf
        <div class="mb-3">
            <label>Видана книга</label>
            <select name="loan_id" class="form-control" required>
                @foreach($loans as $loan)
                    <option value="{{ $loan->id }}">{{ $loan->book->title }} / {{ $loan->reader->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Дата повернення</label>
            <input type="date" name="return_date" class="form-control" required>
        </div>
        <button class="btn btn-primary">Зберегти</button>
    </form>
@endsection