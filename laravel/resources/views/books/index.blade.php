@extends('layouts.app')

@section('content')
    {{-- Повідомлення про успіх --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1>Книги</h1>

    <a href="{{ route('books.create') }}" class="btn btn-success mb-2">+ Додати</a>

    {{-- Форма фільтрації --}}
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="title" value="{{ request('title') }}" class="form-control"
                    placeholder="Назва книги">
            </div>

            <div class="col-md-3">
                <select name="author_id" class="form-control">
                    <option value="">Всі автори</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <input type="number" name="itemsPerPage" value="{{ request('itemsPerPage', 10) }}" class="form-control"
                    placeholder="К-сть на сторінці" min="1">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Фільтрувати</button>
            </div>
        </div>
    </form>

    {{-- Таблиця книг --}}
    <table class="table">
        <thead>
            <tr>
                <th>Назва</th>
                <th>Автор</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">Редагувати</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Впевнені?')">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Пагінація --}}
    <div class="d-flex justify-content-center">
        {{ $books->links('pagination::bootstrap-4') }}
    </div>
@endsection