@extends('layouts.app')
@section('content')
    <h1>Читачі</h1>
    <a href="{{ route('readers.create') }}" class="btn btn-success mb-2">+ Додати</a>
    <table class="table">
        <tr>
            <th>Ім’я</th>
            <th>Email</th>
            <th>Дії</th>
        </tr>
        @foreach($readers as $reader)
            <tr>
                <td>{{ $reader->name }}</td>
                <td>{{ $reader->email }}</td>
                <td>
                    <a href="{{ route('readers.edit', $reader) }}" class="btn btn-warning btn-sm">Редагувати</a>
                    <form action="{{ route('readers.destroy', $reader) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection