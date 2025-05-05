@extends('layouts.app')
@section('content')
    <h1>Редагувати книгу</h1>
    <form method="POST" action="{{ route('books.update', $book) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Назва</label>
            <input type="text" name="title" value="{{ $book->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Автор</label>
            <select name="author_id" class="form-control" required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>{{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Оновити</button>
    </form>
@endsection