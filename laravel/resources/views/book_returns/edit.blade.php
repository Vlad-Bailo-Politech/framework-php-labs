@extends('layouts.app')
@section('content')
    <h1>Редагувати повернення</h1>
    <form method="POST" action="{{ route('book_returns.update', $bookReturn) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Видана книга</label>
            <select name="loan_id" class="form-control" required>
                @foreach($loans as $loan)
                    <option value="{{ $loan->id }}" {{ $bookReturn->loan_id == $loan->id ? 'selected' : '' }}>
                        {{ $loan->book->title }} / {{ $loan->reader->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Дата повернення</label>
            <input type="date" name="return_date" value="{{ $bookReturn->return_date }}" class="form-control" required>
        </div>
        <button class="btn btn-primary">Оновити</button>
    </form>
@endsection