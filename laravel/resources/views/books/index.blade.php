@extends('layouts.app')
@section('content')
    <h1>Книги</h1>
    <a href="{{ route('books.create') }}" class="btn btn-success mb-2">+ Додати</a>
    <table class="table">
        <tr>
            <th>Назва</th>
            <th>Автор</th>
            <th>Дії</th>
        </tr>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author->name }}</td>
                <td>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">Редагувати</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection