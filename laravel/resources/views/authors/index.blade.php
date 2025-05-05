@extends('layouts.app')
@section('content')
    <h1>Автори</h1>
    <a href="{{ route('authors.create') }}" class="btn btn-success mb-2">+ Додати</a>
    <table class="table">
        <tr>
            <th>Ім’я</th>
            <th>Дії</th>
        </tr>
        @foreach($authors as $author)
            <tr>
                <td>{{ $author->name }}</td>
                <td>
                    <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning btn-sm">Редагувати</a>
                    <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection