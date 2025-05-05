<!DOCTYPE html>
<html>

<head>
    <title>Library System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <nav class="mb-4">
            <a href="{{ route('authors.index') }}" class="btn btn-outline-primary">Автори</a>
            <a href="{{ route('books.index') }}" class="btn btn-outline-primary">Книги</a>
            <a href="{{ route('readers.index') }}" class="btn btn-outline-primary">Читачі</a>
            <a href="{{ route('loans.index') }}" class="btn btn-outline-primary">Позики</a>
            <a href="{{ route('book_returns.index') }}" class="btn btn-outline-primary">Повернення</a>
        </nav>
        @yield('content')
    </div>
</body>

</html>