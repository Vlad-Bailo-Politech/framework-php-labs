{{-- resources/views/readers/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Читачі</h1>

    {{-- Повідомлення про успіх --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('readers.create') }}" class="btn btn-success mb-2">+ Додати</a>

    {{-- Фільтрація --}}
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Ім’я читача">
            </div>
            <div class="col-md-3">
                <input type="text" name="email" value="{{ request('email') }}" class="form-control" placeholder="Email">
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

    {{-- Таблиця читачів --}}
    <table class="table">
        <thead>
            <tr>
                <th>Ім’я</th>
                <th>Email</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach($readers as $reader)
                <tr>
                    <td>{{ $reader->name }}</td>
                    <td>{{ $reader->email }}</td>
                    <td>
                        <a href="{{ route('readers.edit', $reader) }}" class="btn btn-warning btn-sm">Редагувати</a>
                        <form action="{{ route('readers.destroy', $reader) }}" method="POST" style="display:inline;">
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
        {{ $readers->links('pagination::bootstrap-4') }}
    </div>
@endsection