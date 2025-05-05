@extends('layouts.app')
@section('content')
    <h1>Видати книгу</h1>
    <form method="POST" action="{{ route('loans.store') }}">
        @csrf
        <div class="mb-3">
            <label>Книга</label>
            <select name="book_id" class="form-control" required>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Читач</label>
            <select name="reader_id" class="form-control" required>
                @foreach($readers as $reader)
                    <option value="{{ $reader->id }}">{{ $reader->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Дата видачі</label>
            <input type="date" name="loan_date" class="form-control" required>
        </div>
        <button class="btn btn-primary">Зберегти</button>
    </form>
@endsection