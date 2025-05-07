{{-- resources/views/authors/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Автори</h1>

    {{-- Повідомлення про успіх --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('authors.create') }}" class="btn btn-success mb-2">+ Додати</a>

    {{-- Форма фільтрації --}}
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Ім’я автора">
            </div>
            <div class="col-md-2">
                <input type="number" name="itemsPerPage" value="{{ request('itemsPerPage', 10) }}" class="form-control" placeholder="К-сть на сторінці" min="1">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Фільтрувати</button>
            </div>
        </div>
    </form>

    {{-- Таблиця авторів --}}
    <table class="table">
        <thead>
            <tr>
                <th>Ім’я</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach($authors as $author)
                <tr>
                    <td>{{ $author->name }}</td>
                    <td>
                        <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning btn-sm">Редагувати</a>
                        <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display:inline;">
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
        {{ $authors->links('pagination::bootstrap-4') }}
    </div>
@endsection