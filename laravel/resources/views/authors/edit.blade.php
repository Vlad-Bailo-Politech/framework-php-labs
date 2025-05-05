@extends('layouts.app')
@section('content')
    <h1>Редагувати автора</h1>
    <form method="POST" action="{{ route('authors.update', $author) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Ім’я</label>
            <input type="text" name="name" value="{{ $author->name }}" class="form-control" required>
        </div>
        <button class="btn btn-primary">Оновити</button>
    </form>
@endsection