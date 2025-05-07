@extends('layouts.app')

@section('content')
    <h1>Позики</h1>

    {{-- Повідомлення про успіх --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('loans.create') }}" class="btn btn-success mb-2">+ Додати</a>

    {{-- Форма фільтрації --}}
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="date" name="loan_date" value="{{ request('loan_date') }}" class="form-control" placeholder="Дата позики">
            </div>
            <div class="col-md-3">
                <select name="book_id" class="form-control">
                    <option value="">Всі книги</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}" {{ request('book_id') == $book->id ? 'selected' : '' }}>
                            {{ $book->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="reader_id" class="form-control">
                    <option value="">Всі читачі</option>
                    @foreach($readers as $reader)
                        <option value="{{ $reader->id }}" {{ request('reader_id') == $reader->id ? 'selected' : '' }}>
                            {{ $reader->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="itemsPerPage" value="{{ request('itemsPerPage', 10) }}" class="form-control" placeholder="К-сть на сторінці" min="1">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">Фільтрувати</button>
            </div>
        </div>
    </form>

    {{-- Таблиця --}}
    <table class="table">
        <thead>
            <tr>
                <th>Дата позики</th>
                <th>Книга</th>
                <th>Читач</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
                <tr>
                    <td>{{ $loan->loan_date }}</td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->reader->name }}</td>
                    <td>
                        <a href="{{ route('loans.edit', $loan) }}" class="btn btn-warning btn-sm">Редагувати</a>
                        <form action="{{ route('loans.destroy', $loan) }}" method="POST" style="display:inline;">
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
        {{ $loans->links('pagination::bootstrap-4') }}
    </div>
@endsection