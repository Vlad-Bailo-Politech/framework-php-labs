@extends('layouts.app')
@section('content')
    <h1>Новий читач</h1>
    <form method="POST" action="{{ route('readers.store') }}">
        @csrf
        <div class="mb-3">
            <label>Ім’я</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button class="btn btn-primary">Зберегти</button>
    </form>
@endsection