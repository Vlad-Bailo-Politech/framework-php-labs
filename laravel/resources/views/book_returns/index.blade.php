@extends('layouts.app')
@section('content')
    <h1>Повернення книг</h1>
    <a href="{{ route('book_returns.create') }}" class="btn btn-success mb-2">+ Повернення</a>
    <table class="table">
        <tr>
            <th>Книга</th>
            <th>Читач</th>
            <th>Дата повернення</th>
            <th>Дії</th>
        </tr>
        @foreach($bookReturns as $return)
            <tr>
                <td>{{ $return->loan->book->title }}</td>
                <td>{{ $return->loan->reader->name }}</td>
                <td>{{ $return->return_date }}</td>
                <td>
                    <a href="{{ route('book_returns.edit', $return) }}" class="btn btn-warning btn-sm">Редагувати</a>
                    <form action="{{ route('book_returns.destroy', $return) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection