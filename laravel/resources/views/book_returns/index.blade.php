@section('content')
    <h1>Повернення книг</h1>

    {{-- Повідомлення про успіх --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @extends('layouts.app')

    <a href="{{ route('book_returns.create') }}" class="btn btn-success mb-2">+ Додати</a>

    {{-- Форма фільтрації --}}
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="date" name="return_date" value="{{ request('return_date') }}" class="form-control"
                    placeholder="Дата повернення">
            </div>
            <div class="col-md-3">
                <select name="loan_id" class="form-control">
                    <option value="">Всі позики</option>
                    @foreach($loans as $loan)
                        <option value="{{ $loan->id }}" {{ request('loan_id') == $loan->id ? 'selected' : '' }}>
                            {{ $loan->book->title }} ({{ $loan->reader->name }})
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
                <input type="number" name="itemsPerPage" value="{{ request('itemsPerPage', 10) }}" class="form-control"
                    placeholder="К-сть на сторінці" min="1">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">Фільтрувати</button>
            </div>
        </div>
    </form>

    {{-- Таблиця повернень --}}
    <table class="table">
        <thead>
            <tr>
                <th>Дата повернення</th>
                <th>Книга</th>
                <th>Читач</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach($returns as $return)
                <tr>
                    <td>{{ $return->return_date }}</td>
                    <td>{{ $return->loan->book->title }}</td>
                    <td>{{ $return->loan->reader->name }}</td>
                    <td>
                        <a href="{{ route('book_returns.edit', $return) }}" class="btn btn-warning btn-sm">Редагувати</a>
                        <form action="{{ route('book_returns.destroy', $return) }}" method="POST" style="display:inline;">
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
        {{ $returns->links('pagination::bootstrap-4') }}
    </div>
@endsection