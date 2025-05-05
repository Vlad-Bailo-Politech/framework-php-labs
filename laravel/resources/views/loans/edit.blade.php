@extends('layouts.app')
@section('content')
    <h1>Редагувати видачу</h1>
    <form method="POST" action="{{ route('loans.update', $loan) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Книга</label>
            <select name="book_id" class="form-control" required>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ $loan->book_id == $book->id ? 'selected' : '' }}>{{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Читач</label>
            <select name="reader_id" class="form-control" required>
                @foreach($readers as $reader)
                    <option value="{{ $reader->id }}" {{ $loan->reader_id == $reader->id ? 'selected' : '' }}>{{ $reader->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Дата видачі</label>
            <input type="date" name="loan_date" value="{{ $loan->loan_date }}" class="form-control" required>
        </div>
        <button class="btn btn-primary">Оновити</button>
    </form>
@endsection