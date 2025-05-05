@extends('layouts.app')
@section('content')
    <h1>Видані книги</h1>
    <a href="{{ route('loans.create') }}" class="btn btn-success mb-2">+ Видати</a>
    <table class="table">
        <tr>
            <th>Книга</th>
            <th>Читач</th>
            <th>Дата видачі</th>
            <th>Дії</th>
        </tr>
        @foreach($loans as $loan)
            <tr>
                <td>{{ $loan->book->title }}</td>
                <td>{{ $loan->reader->name }}</td>
                <td>{{ $loan->loan_date }}</td>
                <td>
                    <a href="{{ route('loans.edit', $loan) }}" class="btn btn-warning btn-sm">Редагувати</a>
                    <form action="{{ route('loans.destroy', $loan) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection