@extends('layouts.app')
@section('content')
    <h1>Редагувати читача</h1>
    <form method="POST" action="{{ route('readers.update', $reader) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Ім’я</label>
            <input type="text" name="name" value="{{ $reader->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $reader->email }}" class="form-control" required>
        </div>
        <button class="btn btn-primary">Оновити</button>
    </form>
@endsection